<?php
	error_reporting(0);
	session_start();
	
	$role = $_SESSION['role'];
	if(!isset($_SESSION['Serial']) && $role!="clerk")  {
		header('location:login.php');
		die();
	} else {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['UserID'];
		$role = "clerk";
		
	}
	
	//define variables and set them to empty values
	$fileNum = $name = $date = $subject = $shera = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		include_once("connectivity.php");			
			$fileNum = $_POST['fileNum'];
			$name = $_POST['name'];
			$date = $_POST['date'];
			$subject = $_POST['subject'];
			$shera = $_POST['shera'];
	
			//insert data into table
			$sql = "INSERT INTO records ( fileNum, name, date, subject, shera, userID )
        		VALUES ('$fileNum', '$name', '$date', '$subject', '$shera','$userID')";
	
			if($conn->query($sql) === true){
				echo "Table updated successfully";
				header('location:clerical.php');			
			} else {
				alert("Error: Unable to update Record");
			}
			$conn -> close();
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
<title>Clerical Entry page</title>
<style>
	.box{
		height:100%;
		padding-top: 20px;
	}
	p{
		line-height: 2;
	}
	strong{
		font-size: 120%;
</style>
</head>
<body>
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="monitor.php" target="_blank">Treasury</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="clerical.php">Home</a></li>
				<li><a href="viewMails.php">Mails</a></li>
				<li><a href="records.php">Records</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="clerkProfile.php" ><span class="glyphicon glyphicon-user"> </span><?php echo " $userID"; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout</a>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="modal-header">
				<h2>Enter the Information</h2>
			</div>
		</div>
		<div class="row" style="margin-top:20px;">
			<div class="col-sm-4" style="background-color:#f1f1f1;">
				<div>
					<h3>About</h3>
				</div>
				<p>Enter the information and press <button class="btn btn-xs btn-success">Save</button> button to save the information or
					press <button class="btn btn-xs btn-info">Reset</button> button to clear the input areas.</p>
				<p>You can later edit the information from <a href="records.php">records</a></p>.
				<p>Click on your <a>userID</a> on top right side of the window in navigation bar to view and update your profile
					information</p>
				<p>Click on <a>logout</a> to close the session.</p>
			</div>
			<div class="col-sm-8">
				<form class="form-horizontal" role="form" action="clerical.php" method="post">
					<div class="form-group">
						<label for="fileNum" class="col-sm-2 control-label">1. File No. :</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name = "fileNum" maxlength="50" required>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">2. NAME :</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="name" maxlength="400">
						</div>
					</div>
					<div class="form-group">
						<label for="date" class="col-sm-2 control-label">3. DATE :</label>
						<div class="col-sm-6">
							<input class="form-control" type="date" name = "date" required>
						</div>
					</div>
					<div class="form-group">
						<label for="subject" class="col-sm-2 control-label">4. SUBJECT :</label>
						<div class="col-sm-6">
							<textarea class="form-control" rows="5" name="subject"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="shera" class="col-sm-2 control-label">5. SHERA :</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="shera" maxlength="50">
						</div>
					</div>
					<br>
					<div class="form-group" align="center">
						<button class="btn btn-success col-sm-4" type="submit"><strong>Save</strong></button>
						<div class="col-sm-1"><h4 class="text-center">OR</h4></div>
						<button class="btn btn-info col-sm-4" type="reset" value="Reset"><strong>Reset</strong></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>