<?php
	require '+/sql.php';
	require '+/usersonly.php';

    $chatId = $_GET['chat'];

    $result = mysqli_query($con,"SELECT * FROM chats WHERE id='$chatId'");
    if (!$result) {
         echo("Error description: " . mysqli_error($con). "/n");
    }
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    $userIdArray = explode(",", $row['userIds']);
    if(!in_array($userId, $userIdArray)){
        echo('<script>alert("You do not have permission to view this chat")</script>');
        die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <title><?=$row['chatName']; ?></title>
        <? require('+/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="+/chatStyle.css">
        <script type="text/javascript">
            var chat = <?= $chatId ?>;
            var userId = <?= $userId; ?>;
            var username = "<?=  $username; ?>";
            var newestArray = [1];
            var newest = 0;
            var canSend= false;

            function htmlEscape(str) {
                return $('<div/>').text(str).html();
            }
            $(document).ready(function(){
                function refresh(){  
                    $.ajax({
                        type: "POST",
                        data: {chat: chat, selectAfter: newest},
                        url: "scripts/displaychat.php",
                        dataType: "xml",
                        success: function(xml){
                            $(xml).find('msg').each(function(){
                                var msgClass = $(this).find('senderId').text() == userId ? "right":"left" ;
                                var msgContent = $(this).find('content').text();
                                msgContent = htmlEscape(msgContent);
                                //$('<div />').text('Some text with <div>html</div>').html()
                                var msgId = $(this).find('id').text();
                                var msgSender = $(this).find('senderUsername').text();
                                if(msgId != newest){
                                    if(msgSender==username){
                                        $("#chatTable").append('<tr class="' + msgClass + '"><td width="50px"></td><td><div class="chat-bubble ' + msgClass + '">' + msgContent +'</div></td><td><img class="userThumb" alt="' + msgSender + '" width="50" title="' + msgSender + '"src="u/'+ msgSender +'/thumb.jpg"></td></tr>');
                                        //$('#chatTableHolder').animate({scrollTop: $('#chatTableHolder')[0].scrollHeight}, 200);
                                    } else {
                                        $("#chatTable").append('<tr class="' + msgClass + '"><td><img class="userThumb" alt="' + msgSender + '" width="50" title="' + msgSender + '"src="u/'+ msgSender +'/thumb.jpg"></td><td><div class="chat-bubble ' + msgClass + '">' + msgContent +'</div></td><td width="50px"></td></tr>');
                                        //$('#chatTableHolder').animate({scrollTop: $('#chatTableHolder')[0].scrollHeight}, 200);
                                    }
                                }
                                newestArray.push(msgId);
                                newest = newestArray.slice(-1)[0];
                            });
                        },
                        error: function() {
                            //alert("An error occurred while processing XML file.");
                        },
                        complete: function() {
                            setTimeout(refresh(), 7000);
                        }
                    });  
                    canSend = true;   
                };

                function send(){
                    if(canSend && $("#chatField").val() != null || $("#chatField").val() != " " || $("#chatField").val() != ""){
                        canSend = false;
                        var msg = $("#chatField").val();
                        msg = htmlEscape(msg);
                        $.ajax({
                            type: "POST",
                            url: "scripts/sendchat.php",
                            data: { chat: chat, msg: msg },
                            success: function(xml){
                                $("#chatField").val("");
                                refresh();
                                $('#chatTableHolder').animate({scrollTop: $('#chatTableHolder')[0].scrollHeight}, 200);
                            },
                            error: function() {
                                alert("Could not send");
                            },
                            complete: function() {
                                canSend = true;
                            }
                        });
                    }
                }
                $("#send").click(function(){
                   send();
                }); 
                $('#chat').submit(function(event){
                  	event.preventDefault();
                 	send();
                });
                $('#chatTableHolder').animate({scrollTop: $('#chatTableHolder')[0].scrollHeight}, 2);
                refresh();
            }); 
        </script>
    </head>
    <body>
        <? require('+/header.php'); ?>
        <div id="chatTableHolder">
        <table id="chatTable"> </table>
        </div>
		<form id="chat">
				<table width="100%">				
					<tr>
						<td width="90%"><input type="text" name="msg" placeholder="Hello" id="chatField" autofocus></td>
					<td width="10%">
						<button type="button" id="send">Go</button>
					</td></tr>
				</table>
			</form>
	</body>
</html>