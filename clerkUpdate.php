<?php
	error_reporting(E_ALL & ~E_NOTICE);
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
		$serialNum=isset($_GET['serialNum']) ? $_GET['serialNum'] : die('ERROR: Record ID not found.');
		
		include_once("connectivity.php");
		
		//SENDING QUERY FOR FETCHING ROW
		$sql = "SELECT * FROM records WHERE serialNum =".$serialNum;
		$result = mysqli_query($conn, $sql);
		
		$row = mysqli_fetch_assoc($result);
		
		$fileNum = $row['fileNum'];
		$name = $row['name'];
		$date = $row['date'];
		$subject = $row['subject'];
		$shera = $row['shera'];
		$status = $row['status'];
		
		
		//UPDATE TABLE
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$fileNumNew = $_POST['fileNum'];
			$nameNew = $_POST['name'];
			$dateNew = $_POST['date'];
			$subjectNew = $_POST['subject'];
			$sheraNew = $_POST['shera'];
			$statusNew = $_POST['status'];
			
			//SEND QUERY
			$sql = "UPDATE records SET fileNum = '$fileNumNew', name = '$nameNew', date = '$dateNew', subject = '$subjectNew', shera = '$sheraNew', status = '$statusNew' WHERE serialNum = '$serialNum'";
			
			if($conn->query($sql) === true) {
				header('location:records.php');
			}
			else {
				echo "Error: " .$sql. "<br>" .$conn->error;
			}
			$conn->close();
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
<title>Update page</title>
</head>
<body>
	<nav class="nav navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand"  href="monitor.php" target="_blank">Treasury</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="clerical.php">Home</a>
					<li><a href="viewMails.php">Mails</a>
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
			<h2>Update the Record</h2>
		</div>
		<div class="row">
		<form class="form-horizontal" role="form" id="edit-form" method="post" action="clerkUpdate.php?serialNum=<?php echo $serialNum ?>">
				<div class="form-group">
					<label for="serialNum" class="col-sm-2 control-label">Serial No. :</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="serialNum" value="<?php echo $serialNum; ?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label for="fileNum" class="col-sm-2 control-label">File No. :</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="fileNum" name="fileNum" value="<?php echo $fileNum; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name(s) :</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="subject" class="col-sm-2 control-label">Subject :</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="subject" rows="5" name="subject" ><?php echo $subject; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="date" class="col-sm-2 control-label">Date :</label>
					<div class="col-sm-10">
						<input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="shera" class="col-sm-2 control-label">Shera :</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="shera" name="shera" value="<?php echo $shera; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="status" class="col-sm-2 control-label">Status :</label>
					<div class="col-sm-10">
						<select class="form-control" id="status" name="status" value="<?php echo $status; ?>" required>
							<option>Unprocessed</option>
							<option>Processed</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Save Changes">
					<a type="button" class="btn btn-danger" href="records.php">Close</a>
				</div>
			</form>
		</div>
		</div>
</body>
</html>
