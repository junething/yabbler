<?php
	session_start();
	if(isset($_SESSION['loggedIn'])) {
		$username=  $_SESSION['loggedIn']['username'];
		$userId=  $_SESSION['loggedIn']['userId'];
		$ENpassword= $_SESSION['loggedIn']['ENpassword'] ;
	}
?>