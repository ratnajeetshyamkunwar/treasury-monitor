<?php
error_reporting(0);
session_start();

$loginErr = "";

if($_POST['submit']) {
	include_once("connectivity.php");
	$userID = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	$role = strip_tags($_POST['role']);

	$sql = "SELECT Serial, Username, Password, role FROM Admin WHERE username= '$userID' AND Activate='1' LIMIT 1";

	$query = mysqli_query($conn, $sql);

	if($query) {
		$row = mysqli_fetch_row($query);
		$serial = $row[0];
		$dbUsername = $row[1];
		$dbPassword = $row[2];
		$dbRole = $row[3];
	}

	if($userID == $dbUsername && $password == $dbPassword && $role == $dbRole){
		$_SESSION['username'] = $userID;
		$_SESSION['Serial'] = $serial;
		$_SESSION['role'] = $role;
		header('location:admin.php');
	} else {
		$loginErr = "Incorrect Username or Password";
	}
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
<title>Admin Login</title>
</head>
<body>
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="monitor.php" target="_blank">Treasury</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php" ><span class="glyphicon glyphicon-log-in"> </span> Login</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-offset-4" style="padding-top: 50px;">
				<h3>Admin Login</h3><br>
				<form role="form" class="form-horizontal" action="adminlogin.php" method="post">
					<span style="color:red"><?php echo $loginErr; ?></span>	
					<div class="form-group">
						<input type="hidden" name="role" value="admin">
		 				<input type="text" placeholder="Username" name="username" maxlength="10" class="form-control">
		 			</div>
		 			<div class="form-group">
		 				<input type="password" placeholder="Password" name="password" maxlength="20" class="form-control">
		 			</div>
		 			<div class="form-group">
		 				<input type="submit" name="submit" value="Login" class="btn btn-success btn-block">
		 			</div>
			 		</div>
		 		</form>
	 		</div>
	 	</div>
	</div>
</body>
</html>