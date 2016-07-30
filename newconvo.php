<?
	require('+/sql.php');
	require('+/usersonly.php')
?>
<html>
	<head>
		<?
			include('+/head.php');
		?>
	</head>
	<body>
	<? include('+/header.php');?>
		<form method="post" action="scripts/newconvo.php">
		Yabbler now supports group chats, seperate usernames, or emails by ","<br>
			<input type="text" name="to" placeholder="Username or Email"></input><br>
			<input type="text" name="chatName" placeholder="Chat Name"></input>
			<button style="background: #008DAA;" type="submit" name="submit">Go</button>
		</form>
	</body>
</html>
