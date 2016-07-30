<?php
	include("header.php");
	require("SQLconnect.php");
	$result= mysqli_query($con, "SHOW tables");
	$username= $_SESSION['signedIn']['username'];
	$result2= mysqli_query($con, "sp_tables '%cust%'");
	echo $result2;
	echo $result;
?>
