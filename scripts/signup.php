<?
	//external scripts
	require("../+/sql.php");
	require("../+/functions.php");
	//varaibles
	$SUusername=$_POST['SUusername'];
	$SUfirstname=$_POST['SUfirstname'];
	$SUlastname=$_POST['SUlastname'];
	$SUpassword=$_POST['SUpassword'];
	$SUpassword2=$_POST['SUpassword2'];
	$SUemail=$_POST['SUemail'];
	$over13= ($_POST['age']=="over13") ? TRUE : FALSE;
	$readTerms= ($_POST['terms']=="read") ? TRUE : FALSE;
	$cSUusername=clean($con, $SUusername);
	$cSUfirstname=clean($con,$SUfirstname);
	$cSUlastname=clean($con,$SUlastname);
	$cSUemail=clean($con,$SUemail);
	$ENSUpassword= md5($SUpassword);
	$code= md5($SUusername);
	$code= str_shuffle($code);
	$code2 = rand(0, 1000);
	$code2= bin2hex($code2);
	$code = $code2;
	$ulen=strlen($SUusername);
	$plen=strlen($SUpassword);

	//check details
	$errors = 0;
	$errorURL = "?";
	if($ulen<3) {
		$errorURL.= "uts=1";
		++$errors;
	}
	if($plen<6){
		($errors > 0) ? $errorURL.= ",pts=1" : $errorURL.= "pts=1";;
		++$errors;
	}
	if(preg_match("#^[a-zA-Z0-9]+$#", $text)){
   		($errors > 0) ? $errorURL.= ",unv=1" : $errorURL.= "unv=1";;
    	++$errors;
	}
	if($SUpassword !== $SUpassword2){
   		($errors > 0) ? $errorURL.= ",pdm=1" : $errorURL.= "pdm=1";;
    	++$errors;
	}
	if(strpos($SUemail,'@') === false || strpos($SUemail,'.') === false){
		($errors > 0) ? $errorURL.= ",env=1" : $errorURL.= "env=1";;
		++$errors;
	}
	$returnUsername = mysqli_query($con, "SELECT username FROM users WHERE username = $cSUusername");
	if($returnUsername == $cSUusername){
		($errors > 0) ? $errorURL.= ",una=1" : $errorURL.= "una=1";;
		++$errors;
	}
	if($SUpassword !== $SUpassword2){
   		($errors > 0) ? $errorURL.= ",pwdm=1" : $errorURL.= "pts=1";;
    	++$errors;
	}
	if(!$over13){
   		($errors > 0) ? $errorURL.= ",noe=1" : $errorURL.= "noe=1";;
    	++$errors;
	}
	if(!$readTerms){
   		($errors > 0) ? $errorURL.= ",nrt=1" : $errorURL.= "nrt=1";;
    	++$errors;
	}
	if($errors > 0){
		header('Location: /signup.php'.$errorURL);
		die();
	}
	//Add user to database
	$sql = "INSERT INTO users(username, firstname, lastname, password, email, signupDate, lastLoginDate, activationCode) VALUES('$cSUusername','$cSUfirstname','$cSUlastname', '$ENSUpassword', '$cSUemail', CURDATE(), CURDATE(), '$code')";
	if (!mysqli_query($con,$sql)) {
	 	echo("Error description: " . mysqli_error($con));
	}
	//Mail activation code
	$subject = 'Your Activation Code';
	$message =  "Your Yabbler activation code:<br><b>$code<b> <br>If you did not sign up for a Yabbler account you can safely ignore this email.";
	$message = wordwrap($message, 70, "\r\n");
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "To: $SUfirstname <${SUemail}>" . "\r\n";
	$headers .= 'From: Yabbler<accounts@yabbler.xyz>' . "\r\n";
	$headers .= 'Reply-to: Yabbler<contact@yabbler.xyz>' . "\r\n";
	mail($to, $subject, $message, $headers);

	//Create user dictionary
	$path = "../u/".$SUusername;
	mkdir($path, 0755);
	$newUserFile = fopen("../u/".$SUusername."/index.php", "w") or die("Unable to open file!");
	$txt = file_get_contents("../+/userpagecontents.txt");
	fwrite($newUserFile, $txt);
	fclose($newUserFile);

	//Image
	//upload
	$target_dir = '../u/'.$SUusername. '/';
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$target_file2 = $target_dir . 'profile.' . $imageFileType;
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg") {
	    echo "Sorry, only JPG files are allowed in beta.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file2)) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
	/*
	//Convert
	//if($imageFileType != "jpg"){
		echo $imageFileType;
		echo "yoyoyoyo";
	    $originalImage = $target_file2;
	    $exploded = explode('.',$originalImage);
	    $ext = $exploded[count($exploded) - 1]; 

	    if (preg_match('/jpg|jpeg/i',$ext))
	        $imageTmp=imagecreatefromjpeg($originalImage);
	    else if (preg_match('/png/i',$ext))
	        $imageTmp=imagecreatefrompng($originalImage);
	    else if (preg_match('/gif/i',$ext))
	        $imageTmp=imagecreatefromgif($originalImage);
	    else if (preg_match('/bmp/i',$ext))
	        $imageTmp=imagecreatefrombmp($originalImage);
	    else
	    	echo "Fail converting image";

	    unlink($originalImage);
	    // quality is a value from 0 (worst) to 100 (best)
	    imagejpeg($imageTmp, $target_file2, 100);
	    imagedestroy($imageTmp);
	//}
 */
	//crop
	$image = imagecreatefromjpeg('../u/'.$SUusername.'/profile.jpg');
	$filename = '../u/'.$SUusername.'/thumb.jpg';

	$thumb_width = 200;
	$thumb_height = 200;

	$width = imagesx($image);
	$height = imagesy($image);

	$original_aspect = $width / $height;
	$thumb_aspect = $thumb_width / $thumb_height;

	if ( $original_aspect >= $thumb_aspect )
	{
	   // If image is wider than thumbnail (in aspect ratio sense)
	   $new_height = $thumb_height;
	   $new_width = $width / ($height / $thumb_height);
	}
	else
	{
	   // If the thumbnail is wider than the image
	   $new_width = $thumb_width;
	   $new_height = $height / ($width / $thumb_width);
	}

	$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

	// Resize and crop
	imagecopyresampled($thumb,
	                   $image,
	                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
	                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
	                   0, 0,
	                   $new_width, $new_height,
	                   $width, $height);
	imagejpeg($thumb, $filename, 80);

	//Redirect to activate page
	header('Location: /activateAccount.php?');
?>