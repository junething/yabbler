<?php
require 'SQLconnect.php';

$postTitle= $_POST['postTitle'];
$name= $_POST['name'];
$comment= $_POST['comment'];
$name= mysql_real_escape_string($name);
$comment= mysql_real_escape_string($comment);
echo $title;
$commentTable= "commentsfor".$postTitle;
echo $table;
mysql_query("INSERT INTO $commentTable
(name, comment) VALUES('$name', '$comment',) ") 
or die(mysql_error());  

header("Location:viewPost.php?postTitle=$postTitle");
?>