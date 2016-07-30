<?
	require("+/usersonly.php");
	require("+/sql.php");
	
	$result= mysqli_query($con, "SELECT * FROM chats");
	if (!$result) {
	 	echo("Error description: " . mysqli_error($con));
	}
?>
<htmL>
	<head>
		<? include("+/head.php"); ?>
		<link rel="stylesheet" type="text/css" href="+/style.css">
	</head>
	<body>
		<? include("+/header.php"); ?>
		<div class="location"><i class="fa fa-home"></i> Home <i class="fa fa-angle-right"></i> <i class="fa fa-tachometer"></i> Dashboard</div>
		<br>
		<div class="rightTabs">
			
		</div>
				<br><i class="fa fa-user"></i> Account <br>
				<a class="box" href="#"><div class="box"><i style="color: #57B5E3;" class="icon fa fa-info-circle fa-4x"></i><br>Details</div></a>
				<a class="box" href="#"><div class="box"><i style="color: #ED4E2A;" class="icon fa fa-question-circle fa-4x"></i><br>Help</div></a>
				<a class="box" href="#"><div class="box"><i style="color: #3D3D3D;" class="icon fa fa-lock fa-4x"></i><br>Edit Account</div></a>
				<br><i style="vertical-align: middle;" class="fa fa-comments"></i> Conversations<br>
				<? while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) : ?>
					<? $userArrayStr = explode(',', $row['userIds']);?>
					<? if(in_array($userId,$userArrayStr)): ?>
						<a class="box" href="/chat.php?chat=<?=$row['id']; ?>"><div class="box"><i style="color: #<?=substr(md5(rand()), 4, 6); ?>" class="icon fa fa-comments fa-4x"></i><br><?=$row['chatName']; ?></div></a></div>
					<? endif; ?>
				<? endwhile; ?>
				<a class="box" href="/newconvo.php"><div class="box"><i style="color: #FCB322;" class="icon fa fa-plus-circle fa-4x"></i><br>New Blog</div></a>
				<br><i style="vertical-align: middle;" class="fa fa-user"></i> Other<br>
				<a class="box" href="#"><div class="box"><i style="color: #3D3D3D;" class="fa fa-cogs fa-4x"></i><br>Settings</div></a>
				<a class="box" href="#"><div class="box"><i style="color: #ED4E2A;" class="fa fa-trash-o fa-4x"></i><br>Delete Account</div></a>
	</body>
</htmL>
