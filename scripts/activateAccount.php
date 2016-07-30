<?php
	$url = isset($_GET['url']) ? $_GET['url'] : null;
	$url = urldecode($url);
	require('../+/sql.php');
	$username=$_POST['username'];
	$code=$_POST['code'];
	$password=$_POST['password'];
	$ENpassword=md5($password);
	$result= mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND activationCode='$code' AND password='$ENpassword'") or die($con->error.__LINE__);
	if (!$result) {
	 	echo("Error description: " . mysqli_error($con));
	}
	
	$num_rows = mysqli_num_rows($result);

	if ($num_rows > 0) {
		mysqli_query($con, "UPDATE users SET activationCode='done' WHERE username='$username' AND activationCode='$code' AND password='$ENpassword'") or die($con->error.__LINE__);
		session_start();
		$login = array('userId' => $userId, 'username' => $username, 'ENpassword' => $ENpassword); 
		$_SESSION['signedIn'] = $login;
		$url = ($url != null ?:'/index.php');
		header('Location: /dashboard.php');
	} else {
		header('Location: /activateAccount.php?wrong=1');
	}
?>
