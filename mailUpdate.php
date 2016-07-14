<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	
	$role = $_SESSION['role'];
	if(!isset($_SESSION['Serial']) && $role!="postclerk")  {
		header('location:login.php');
		die();
	} else {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['UserID'];
		$role = "postclerk";
	}
		$serialNum=isset($_GET['serialNum']) ? $_GET['serialNum'] : die('ERROR: Record ID not found.');
		
		include_once("connectivity.php");
		
		//SENDING QUERY FOR FETCHING ROW
		$sql = "SELECT * FROM mails WHERE serialNum =".$serialNum;
		$result = mysqli_query($conn, $sql);
		
		$row = mysqli_fetch_assoc($result);
		
		$name = $row['name'];
		$address = $row['address'];
		$compilation = $row['compilation'];
		$dateSent = $row['dateSent'];
		$dateReceive = $row['dateReceive'];
		$subject = $row['subject'];
		$checkNum = $row['checkNum'];
		$classification = $row['classification'];
		$shera = $row['shera'];
		
		
		//UPDATE TABLE
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$nameNew = $_POST['name'];
			$addressNew = $_POST['address'];
			$compilationNew = $_POST['compilation'];
			$dateSentNew = $_POST['dateSent'];
			$dateReceiveNew = $_POST['dateReceive'];
			$subjectNew = $_POST['subject'];
			$checkNumNew = $_POST['checkNum'];
			$classificationNew = $_POST['classificationNew'];
			$sheraNew = $_POST['shera'];
			
			//SEND QUERY
			$sql = "UPDATE mails SET name = '$nameNew', address = '$addressNew', compilation = '$compilationNew', 
			dateSent = '$dateSentNew', dateReceive = '$dateReceiveNew', subject = '$subjectNew', checkNum = '$checkNum', 
			classification = '$classificationNew', shera = '$sheraNew' WHERE serialNum = '$serialNum'";
			
			if($conn->query($sql) === true) {
				header('location:mails.php');
			}
			else {
				echo "Error: " .$sql. "<br>" .$conn->error;
			}
			
		}
		$conn->close();
		
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<title>Mail Update page</title>
<style>
	strong{
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
					<li><a href="mailEntry.php">Home</a>
					<li><a href="mails.php">Mails</a>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="userprofile.php" ><span class="glyphicon glyphicon-user"> </span><?php echo " $userID"; ?></a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout</a>
				</ul>
			</div>
	</nav>
	<div class="container">
		<div class="row">
			<h2>Update Selected Mail</h2>
		</div>
		<div class="row">
		<form class="form-horizontal" role="form" id="edit-form" method="post" action="mailUpdate.php?serialNum=<?php echo $serialNum ?>">
				<div class="form-group">
					<label for="serialNum" class="col-sm-4 control-label">Serial No. :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="serialNum" value="<?php echo $serialNum; ?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-4 control-label">Name(s) :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="name" maxlength="400" value="<?php echo $name; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="address" class="col-sm-4 control-label">Address :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address" maxlength="400" value="<?php echo $address; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="compilation" class="col-sm-4 control-label">Name and No. of Compilation :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="compilation" maxlength="200" value="<?php echo $compilation; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="dateSent" class="col-sm-4 control-label">Date (Sent) :</label>
					<div class="col-sm-8">
						<input type="date" class="form-control" name="dateSent" value="<?php echo $dateSent; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="dateReceive" class="col-sm-4 control-label">Date (Received) :</label>
					<div class="col-sm-8">
						<input type="date" class="form-control" name="dateReceive" value="<?php echo $dateReceive; ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="subject" class="col-sm-4 control-label">Subject :</label>
					<div class="col-sm-8">
						<textarea class="form-control" rows="5" name="subject" ><?php echo $subject; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="checkNum" class="col-sm-4 control-label">Outward Checking No. :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="checkNum" value="<?php echo $checkNum; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="classification" class="col-sm-4 control-label">Classification :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="classification" maxlength="50" value="<?php echo $classification; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="shera" class="col-sm-4 control-label">Shera :</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="shera" maxlength="50" value="<?php echo $shera; ?>">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><strong>Save Changes</strong></button>
					<a type="button" class="btn btn-danger" href="mails.php"><strong>Close</strong></a>
				</div>
			</form>
		</div>
		</div>
</body>
</html>
