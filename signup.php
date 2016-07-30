<?php
	include('+/header.php');
	if ($_GET['uts']==1)
		echo "<font color='red'>Username too short, must be at least 3 characters long.</font>";
	if ($_GET['pts']==1)
		echo "<font color='red'>Password too short, must be at least 6 characters long.</font>";
	if ($_GET['pwd']==1)
		echo "<font color='red'>Passwords must match.</font>";
	if ($_GET['emn']==1)
		echo "<font color='red'>Please enter a valid email.</font>";
	if ($_GET['tnr']==1)
		echo "<font color='red'>Please read and accept our terms and conditions if you wish to continue</font>";
	if ($_GET['noe']==1)
		echo "<font color='red'>Sorry, you must be over 13 to use our services.</font>";
?>
<link rel="stylesheet" type="text/css" href="+/style.css">
	</head>
	<body>
	<div class="signup">
		<form method="post" action="scripts/signup.php" enctype="multipart/form-data">
			<strong>Username</strong><br>
			<input class="signup" type="text" name="SUusername" placeholder="(No Spaces!)"><br>
			<strong>Name</strong><br>
			<input class="signup name" type="text" name="SUfirstname" placeholder="First"><input class="signup name" type="text" name="SUlastname" placeholder="Last"<br>
			<strong>Profile Image(jpg only)</strong><br>
			<input type="file" name="fileToUpload" id="fileToUpload"><br>
			<strong>Email</strong><br>
			<input class="signup" input type="text" name="SUemail" placeholder="Email"><br>
			<strong>Password</strong><br>
			<input class="signup" type="password" name="SUpassword" placeholder="Password"><br>
			<strong>Password</strong><br>
			<input class="signup" type="password" name="SUpassword2" placeholder="Repeat Password"><br>
			<strong>Age</strong><br>
			<label><input type="checkbox" name="age" value="over13">I am 13 or over.</label><br>
			<label><input type="checkbox" name="terms" value="read">I have read and agree to the terms and conditions.</label><br>
			<button style="background: #008DAA;" type="submit" value="submit" name="submit">Signup</button>
		</form>
		</div>
	</body>
</html>



