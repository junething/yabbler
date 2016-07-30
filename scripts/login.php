<?php
	session_start();
	require("../+/sql.php");
	$url=$_POST['url'];
	$url = urldecode($url);
	$username=mysqli_real_escape_string($con, strip_tags($_POST['username']));
	$password=mysqli_real_escape_string($con, strip_tags($_POST['password']));

	$ENpassword= md5($password);

	$result= mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$ENpassword'");
	if (!$result) {
	 	echo("Error description: " . mysqli_error($con));
	}
	$row=mysqli_fetch_array($result, MYSQLI_BOTH);
	$num_rows = mysqli_num_rows($result);
	$userId = $row['id'];
	if($username=="" || $password==""){
		header('Location: http://yabbler.xyz/login.php?fle=1');
		die();
	}
	if ($row['username']==$username) {
		if($row['activationCode']!=='done') {
			header('Location: http://yabbler.xyz/login.php?ana=1');
			die();
		}
		echo $username;
		echo $password;
		
		
		$login = array('userId' => $userId, 'username' => $username, 'password' => $ENpassword); 

		$_SESSION['loggedIn'] = $login;
		$username2 =  $_SESSION['loggedIn']['username'];
		echo 'session:'.$username2;
		if($url != null){
			header("Location: $url");
			echo "1";
			die();
		} else {
			header("Location: /dashboard.php");
			echo "2";
			die();
		}
	} else {
		header('Location: /login.php?upi=1');
		echo "5";
		die();
	}
?>
