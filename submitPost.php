<?php
require 'SQLconnect.php';

$postBody= $_POST['postBody'];
$postTitle= $_POST['postTitle'];
$postBody= mysql_real_escape_string($postBody);
$postTitle= mysql_real_escape_string($postTitle);
$postTitle=str_replace(" ", "-", $postTitle);
// Insert a row of information into the table "example"
mysql_query("INSERT INTO posts 
(postTitle, postBody) VALUES('$postTitle', '$postBody' ) ") 
or die(mysql_error());   

mysql_query("CREATE TABLE commentsfor$postTitle(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 name VARCHAR(30),
 likes INT,
 comment TEXT)")
 or die(mysql_error());  
 echo "Successfull post!<br>";
echo "<a href=\"addarticle.php\">Make new post</a><br>
<a href=\"http://integer-web.netau.net/newdcc/viewpost.php?title=$postTitle\">Go to post</a>";
?>