<?php 
	error_reporting(0);
	session_start();
	
	$role = $_SESSION['role'];
	if(!isset($_SESSION['Serial']) && $role!="postclerk"){
		header('location:login.php');
		die();
	} else {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['UserID'];
		$role = "postclerk";
	}
	
	//define variables and set them to empty values
	$serialNum = $dateSent = $dateReceive = $name = $commpilation = $subject = $checkNum = $classfication = $shera = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		include_once("connectivity.php"); 
		$name = $_POST['name'];
		$address = $_POST['address'];
		$compilation = $_POST['compilation'];
		$dateSent = $_POST['dateSent'];
		$dateReceive = $_POST['dateReceive'];
		$subject = $_POST['subject'];
		$checkNum = $_POST['checkNum'];
		$classification = $_POST['classification'];
		$shera = $_POST['shera'];
		
		//insert data into table
		$sql = "INSERT INTO mails ( name, address, compilation, dateSent, dateReceive, subject, checkNum, classification, shera, userID )
		VALUES ('$name', '$address', '$compilation', '$dateSent', '$dateReceive', '$subject', '$checkNum', '$classification', '$shera', '$userID')";
		
		if($conn->query($sql) === true){
			echo "Table updated successfully";
			header('location:mailEntry.php');
		} else {
			echo "Error: ".$sql."<br>".$conn->error;
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
<title>Mail Entry</title>
<style>
	p {
		line-height: 2;
		}
	.strong{
		font-size: 120%;
		}
</style>
</head>
<body>
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="monitor.php" target="_blank">Treasury</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="mailEntry.php">Home</a></li>
				<li><a href="mails.php">Mails</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="postClerkProfile.php" ><span class="glyphicon glyphicon-user"> </span><?php echo " $userID"; ?></a></li>
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
			<div class="col-sm-3 about" style="background-color:#f1f1f1;">
				<h4>About</h4>
				<p>Enter the Information and press <button class="btn btn-success btn-xs">Save</button> to save the information
					or press <button class="btn btn-info btn-xs">Refresh</button> to clear the input areas.</p>
				<p>You can also edit information later from <a href="mails.php" >mails</a>.
				<p>Click on your <a>userID</a> on top right side of the window in navigation bar to view and update your profile
					information</p>
				<p>Click on <a>logout</a> to close the session.</p>
			</div>
			<div class="col-sm-1 about"></div>
			<div class="">
				<form role="form" action="mailEntry.php" method="post">
					<div class="col-sm-4">
						<div class="form-group">
							<label  for="name" class="control-label">1. Name(s) :</label>
							<div class="">
								<input class="form-control" type="text" name="name" required>
							</div>
						</div>
						<div class="form-group">
							<label for="address" class="control-label">2. Address :</label>
							<div class="">
								<input class="form-control" type="address" name="address">
							</div>
						</div>
						<div class="form-group">
							<label for="compilation" class="control-label">3. Name and No. of Compilation :</label>
							<div class="">
								<input class="form-control" type="text" name="compilation">
							</div>
						</div>
						<div class="form-group">
							<label for="dateSent" class="control-label">4. Date (Sent) :</label>
							<div class="">
								<input class="form-control" type="date" name="dateSent" required>
							</div>
						</div>
						<div class="form-group">
							<label for="dateReceive" class="control-label">5. Date (Received) :</label>
							<div class="">
								<input class="form-control" type="date" name="dateReceive" required>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="subject" class="control-label">6. Subject :</label>
							<div class="">
								<textarea class="form-control" name="subject" rows="5"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="checkNum" class="label-control">7. Outward Checking No. :</label>
							<div class="">
								<input class="form-control" type="text" name="checkNum">
							</div>
						</div>
						<div class="form-group">
							<label for="classification" class="label-control">8. Classification :</label>
							<div class="">
								<input class="form-control" type="text" name="classification">
							</div>
						</div>
						<div class="form-group">
							<label for="shera" class="control-label">9. Shera :</label>
							<div class="">
								<input class="form-control" type="text" name="shera">
							</div>
						</div>
					</div>
						<div class="form-group">
							<div class="col-sm-8 col-md-offset-4" style="margin-top: 20px;">
								<button class="btn btn-success col-sm-4" type="submit"><strong>Save</strong></button>
								<div class="col-sm-1"><h4 class="text-center">OR</h4></div>
								<button class="btn btn-info col-sm-4" type="reset"><strong>Reset</strong></button>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>