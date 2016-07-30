<?php
	session_start();
	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$url = urlencode($url);
	if(isset($_SESSION['loggedIn'])) {
		$username=  $_SESSION['loggedIn']['username'];
		$userId=  $_SESSION['loggedIn']['userId'];
		$ENpassword= $_SESSION['loggedIn']['ENpassword'] ;
	} else {
		header("Location: http://yabbler.xyz/login.php?url=$url");
	}
?>