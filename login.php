<?php
	error_reporting(0);
	session_start();
	
	$role = $_SESSION['role'];
	if(isset($_SESSION['Serial']) && $role =="admin")  {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['username'];
		$role = "admin";
		header('location: admin.php');
	} elseif(isset($_SESSION['Serial']) && $role == "clerk") {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['UserID'];
		$role = "clerk";
		header('location:clerical.php');
	} elseif(isset($_SESSION['Serial']) && $role == "postclerk"){
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['UserID'];
		$role = "postclerk";
		header('location:mailEntry.php');
	} else {
		header('login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<title>Login page</title>
<style>
	.link{
		color:white;
		text-decoration:none;
	}
	.link:hover{
		text-decoration:none;
	}
</style>
</head>
<body>
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand"  href="monitor.php" target="_blank">Treasury</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php" ><span class="glyphicon glyphicon-log-in"> </span> Login</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-offset-4" style="margin-top:50px;">
				<div class="form-group">
					<h3>Select a login Option</h3><br>
		 			<a class="btn btn-info btn-block link" href="adminLogin.php">Admin</a><br>
		 			<a class="btn btn-info btn-block link" href="clericalLogin.php">Clerk</a><br>
		 			<a class="btn btn-info btn-block link" href="postClerkLogin.php">Post Clerk</a>
		 		</div>
	 		</div>
 		</div>
	</div>
</body>
</html>