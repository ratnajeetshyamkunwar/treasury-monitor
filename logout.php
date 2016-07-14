<?php
	error_reporting(0);
	session_start();
	session_destroy();	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<title>Logout</title>
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
			<div class="text-center" style="padding-top: 50px;">
			<h5>You have been successfully Logged out. Click <a href="login.php">Here</a> to login again.</h5>
			</div>
	</div>
</body>
</html>