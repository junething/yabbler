<?
	$url= $_GET['url'];
	$error= $_GET['error'];
	require('+/getUserSession.php');
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Login to Yabbler</title>
		<? require('+/head.php'); ?>
	</head>
	<body>
		<? require('+/header.php'); ?>
		<div class="login">
			<?
				if ($error==2)
					echo '<font color="red"><i class="fa fa-exclamation-triangle"></i></td><td>Username or Password is incorrect.</font>';
				elseif ($error==3)
					echo '<font color="red"><i class="fa fa-exclamation-triangle"></i></td><td>Account not yet activated(<a href="activateAccount.php?url=$url">Click here to activate</a>).</font>';
				elseif ($error==1)
					echo '<font color="red"><i class="fa fa-exclamation-triangle"></i></td><td>Please fill out all fields.</font>';
			?>
			<form method="post" action="scripts/login.php">
				<input type="text" name="username" placeholder="Username" class="login">
				<input type="password" name="password" placeholder="Password" class="login">	
				<input type="hidden" name="url" value="<?= $url ?>">
				<button style="background: green;" type="submit" name="submit"><i class="fa fa-lock"></i>Login</button>Don't have an account?<a href="signup.php">Signup now</a>
			</form>
		</div>
	</body>
</html>

