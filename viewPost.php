<?php
require 'SQLconnect.php';

$postTitle= $_GET['postTitle'];

$result = mysql_query("SELECT * FROM posts
WHERE postTitle='$postTitle'") or die(mysql_error());  
// get the first (and hopefully only) entry from the result
$row = mysql_fetch_array( $result );
$result2 = mysql_query("SELECT * FROM commentsfor$postTitle ORDER BY likes DESC, id DESC") 
or die(mysql_error());  
// Print out the contents of each row into a table 
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="slideshow.css">
        <script language="JavaScript" src="script.js"></script> 
        <script>
        function display(action, id)
        {
                document.getElementById("link1").className= "tabLink";
                document.getElementById("link2").className= "tabLink";
                document.getElementById("link3").className= "tabLink";
                document.getElementById("link"+id).className= "tabLinkOpen";
                document.getElementById("hideandshow1").style.display = "none";
                document.getElementById("hideandshow2").style.display = "none";
                document.getElementById("hideandshow3").style.display = "none";
                document.getElementById("hideandshow"+id).style.display = "block";
        }
        function readMore(action, id)
        {
            window.location.href="#tabs";
            display('show', id);
        }
    </script>
    </head>
    <body>
        <div class="header">
            <table class="headerTable">
                <tr>
                  <td><img class="headerImage" src="dcclogo1.png" height="60" align="left"></img> <font class="headerTitle"> dahnimbla<b>cc</b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font> </td><td class="headerLinks"> HOME </td><td class="headerLinks">&nbsp;&nbsp;&nbsp; &#8226;&nbsp;&nbsp;&nbsp;</td><td class="headerLinks"> ABOUT </td><td class="headerLinks">&nbsp;&nbsp;&nbsp; &#8226;&nbsp;&nbsp;&nbsp; </td><td class="headerLinks"> GALLERY</td><td class="headerLinks"> &nbsp;&nbsp;&nbsp; &#8226;&nbsp;&nbsp;&nbsp;</td><td class="headerLinks"> BLOG</td>
                </tr>
            </table>
        </div>
        <table width="100%" class="backgroundTable" bgcolor="#ffffff" style="margin-top: 100px;">
             <tr>
                 <td>
                    <?php
						$spacetitle=str_replace("fgh", " ", $row['postTitle']);
						echo "<p class=\"blogTitle\">";
						echo "</p><p class=blogBodyTXT>"; 
						echo $row['postBody'];
						echo "</p>"
					?>
					<table class="commentTable" width="90%" border="1" rules="rows" frame="hsides">
						<form action="submitComment.php" method="post">
							<input type="hidden" name="postTitle" value="<?php echo $postTitle ?>"></input>
							<tr class="tableLine"><td width="20%">
							<input placeholder="Name" type="text" name="name" />
							<br><i style="color: grey;"class="fa fa-user fa-4x"></i>
							</td><td>
							<textarea placeholder="Comment" rows="6" cols="100" name="comment"></textarea>
							<input value="Go" type="submit" />
							</td></tr>
						</form>
					<?php
						// keeps getting the next row until there are no more to get
						while($row2 = mysql_fetch_array( $result2 )) {
						// Print out the contents of each row into a table
						echo '<tr class="tableLine"><td width="20%">'; 
						echo $row2['name'];
						echo '<br><i style="color: grey;"class="fa fa-user fa-4x"></i>';
						echo "</td><td>"; 
						echo $row2['comment'];
						$id= $row2['id'];
						$likes= $row2['likes'];
						echo "<form action=\"likeComment.php\" method=\"post\">
						<input type=\"hidden\" name=\"postTitle\" value=\"$postTitle\" />
						<input type=\"hidden\" name=\"id\" value=\"$id\" />
						<input type=\"hidden\" name=\"title\" value=\"$postTitle\"></input>
						<button class=\"likeButton\" type=\"submit\">$likes</button>
						</form></td></tr>"; 
						} 
						echo "</table>";
					?>
                </td>
            </tr>
        </table>
    </body>
    <footer>
    	<div class="footer">
	        <div class="footerText">
	            <b>Contact</b><br>
	            <i class="fa fa-envelope-o"></i> kaiww@dahnimabla.netau.net<br>
	            <i class="fa fa-envelope-o"></i> webmaster@dahnimbla.netau.net<br>
	        </div>
    	</div>
    	<div class=footerBottom>
	        <div class="footerBottomText">
	            2014 Dahnimbla Community Cooperative. Website created by INTEGER.comli.com</font>
	        </div>
    	</div>
    </footer>
</html>