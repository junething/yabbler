<?php
require 'SQLconnect.php';

$id= $_POST['id'];
$postTitle= $_POST['postTitle'];
$commentTable= "commentsfor".$postTitle;
$result = mysql_query("SELECT * FROM $commentTable
WHERE id='$id'") or die(mysql_error());  
$row = mysql_fetch_array( $result );
$likes= $row['likes'] +1;

$result = mysql_query("UPDATE $commentTable SET likes='$likes' WHERE id='$id'") 
or die(mysql_error());  
header("Location:viewPost.php?postTitle=$postTitle");
?>