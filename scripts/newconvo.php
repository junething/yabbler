<?
	//require 'header.php';
	require '../+/sql.php';
	require '../+/functions.php';
	require '../+/usersonly.php';

echo $username;
echo 'FSDFS';
	$to = mysqli_real_escape_string($con, strip_tags($_POST['to']));
	$msg = mysqli_real_escape_string($con, strip_tags($_POST['msg']));
	$chatName = mysqli_real_escape_string($con, strip_tags($_POST['chatName']));

	$to = str_replace(" ",",",$to);
	$to = str_replace(",,",",",$to);

	$toSearchArray = explode(",", $to);
	$toIdArray[0] = $userId;
	foreach($toSearchArray as $searchStr) {
		$result = mysqli_query($con,"SELECT * FROM users WHERE username='$searchStr' OR email='$searchStr'");
		if ($result){
		$row = mysqli_fetch_array($result, MYSQLI_BOTH);
			array_push($toIdArray, $row['id']);
		}
		unset($result);
	}
	echo "<br>";
	echo $to;
	echo "<br>";
	echo $toIdArray;
	echo "<br>";
	$usersString = implode(",",$toIdArray);
	echo $usersString;
	echo "<br>";
	$sql="INSERT INTO chats(chatName, userIds, created, lastUsed) VALUES('$chatName','$usersString', CURDATE(), CURDATE())";
	if (!mysqli_query($con,$sql)) {
         echo("Error description: " . mysqli_error($con));
    }
	$result1 = mysqli_query($con,"SELECT id FROM chats WHERE chatName='$chatName' AND userIds='$usersString'");
	if (!$result1) {
         echo("Error description: " . mysqli_error($con). "/n");
    }
	$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
	$tableNumber = $row1['id'];
	echo $tableNumber;
	$tableName = 'chat'.$tableNumber;
	$sql1 = "CREATE TABLE $tableName (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	senderId VARCHAR(20),
	senderUsername VARCHAR(20),
	msgContent VARCHAR(9999),
	sent DATE)";
	if (!mysqli_query($con1,$sql1)) {
 		echo("Error description: " . mysqli_error($con1). "/n");
 	}
 	header('Location: /chat.php?chat='.$tableNumber)
?>