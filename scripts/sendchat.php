<?php
	require '../+/sql.php';
	require '../+/usersonly.php';
	$chat = isset($_POST['chat']) ? $_POST['chat'] : null;
	$msg = isset($_POST['msg']) ? $_POST['msg'] : null;
	$chatTable = "chat".$chat;
	if($msg != null) {
		$sql="INSERT INTO $chatTable(senderId, senderUsername, msgContent, sent) VALUES('$userId','$username','$msg', CURDATE())";
		if (!mysqli_query($con1,$sql)) {
			echo("Error description: " . mysqli_error($con1));
		}
	}
?>