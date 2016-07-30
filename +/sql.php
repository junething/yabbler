<?php
	$mysql_host = "mysql.hostinger.co.uk";

	$mysql_database = "u488091188_data";
	$mysql_user = "u488091188_int";

	$mysql_database1 = "u488091188_data1";
	$mysql_user1 = "u488091188_int1";

	$mysql_password = "password";

	$con = new mysqli("mysql.hostinger.co.uk", "u488091188_int", "password", "u488091188_data");
	if ($con->connect_error)
	   echo "Connection failed: " . $con->connect_error;
	$con1 = new mysqli($mysql_host, "u488091188_int1", "password", "u488091188_data1");
	if ($con1->connect_error)
		echo "Connection failed: " . $con1->connect_error;
?>