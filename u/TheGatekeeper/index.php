<?php
if(isset($_SESSION['signedIn'])) {
	$username = $_SESSION['signedIn']['username'];
	$profileuser = basename($_SERVER['REQUEST_URI'], '.php');
	if($username == $profileuser)
		require '../../+/userpage.php';
	else
		require '../../+/profilepage.php';
} else {
		require '../../+/profilepage.php';
}
?>