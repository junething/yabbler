<?php
require '../+/sql.php';
require '../+/functions.php';

// Create database 
/*
$sql = "CREATE DATABASE Data";
if ($con->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
} */
$sql = "CREATE TABLE chats(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	chatName VARCHAR(20),
	owner VARCHAR(20),
	participant1 VARCHAR(20),
	participant2 VARCHAR(20),
	participant3 VARCHAR(20),
	created DATE,
	lastUsed DATE)";
	runSQL($con,$sql);

$sql = "CREATE TABLE users(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
 username VARCHAR(20),
 firstname VARCHAR(30),
 lastname VARCHAR(30),
 nickname VARCHAR(20),
 email VARCHAR(30),
 password VARCHAR(1000),
 signupDate DATE,
 lastLoginDate DATE,
 activationCode VARCHAR(30))";
runSQL($con,$sql);

$sql = "CREATE TABLE teams(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
 fullname VARCHAR(30),
 abbreviation VARCHAR(30),
 organization VARCHAR(30),
 members INT
 projects)";
runSQL($con,$sql);

$sql = "CREATE TABLE projects(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
 fullname VARCHAR(30),
 abbreviation VARCHAR(30),
 organization VARCHAR(30),
 members INT
 projects)";
runSQL($con,$sql);
echo "All good<br>";
echo "<a href=\"addarticle.php\">Make new post</a><br>";

?>
