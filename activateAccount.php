<html>
	<head>
	<title>Activate Account</title>
	<? include("+/head.php"); ?>
	</head>
	<body>
		<? include("+/header.php"); ?>
		<?
			$url =$_GET['url'];
			$wrong =$_GET['wrong'];
			if ($wrong==1)
				echo "<font color='red'>Code, Username or Password is incorrect.</font>";
		?>
		<table align="center"><tr><td>
			<form method="post" action="scripts/activateAccount.php">
				<table>
					<tr><td>
						<input type="text" class="activate" name="code" placeholder="Code(Emailed to you, may be in junk)">
					</td></tr><tr><td>
						<input type="text" class="activate" name="username" placeholder="Username" class="login">
					</td></tr><tr><td>
						<input type="password" class="activate" name="password" placeholder="Password" class="login">
					</td></tr>
				</table>
				<table>
					<tr><td>
						<input type="hidden" name="url" value="<?= $url ?>">
						<button style="background: #FF9800;" type="submit" name="submit"><i class="fa fa-lock"></i>Activate</button>
					</td></tr>
				</table>
			</form>
		</td></tr></table>
	</body>
</html>