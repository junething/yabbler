<?php
require 'SQLconnect.php';

$newPostTitle= $_POST['newPostTitle'];
$oldPostTitle= $_POST['oldPostTitle'];

$newPostBody= $_POST['newPostBody'];

$oldCommentTableName="commentsfor".$oldPostTitle;
$newCommentTableName="commentsfor".$newPostTitle;

$result = mysql_query("UPDATE posts SET postTitle='$newPostTitle' WHERE postTitle='$oldPostTitle'") 
or die(mysql_error());
$result = mysql_query("UPDATE posts SET postBody='$newPostBody' WHERE postTitle='$oldPostTitle'") 
or die(mysql_error());

$val = mysql_query('select * from $oldCommentTable');

if($val !== FALSE)
{
   echo ".";
}else{
   $result = mysql_query("RENAME TABLE $oldCommentTableName TO $newCommentTableName") 
or die(mysql_error());

}

$result = mysql_query("RENAME TABLE $oldCommentTableName TO $newCommentTableName") 
or die(mysql_error());

?>
<html>
<script>
	alert("Edit successful")
	window.location = "editPost.php?postTitle=<?php echo "$newPostTitle" ?>";
</script>
</html>