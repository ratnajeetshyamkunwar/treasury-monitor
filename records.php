<?php
	error_reporting(0);
	session_start();
	
	$role = $_SESSION['role'];
	if(!isset($_SESSION['Serial']) && $role!="clerk")  {
		header('location: login.php');
		die();
	} else {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['UserID'];
		$role = "clerk";
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
<title>file Records</title>
<style>
	.white, .white a{
		color: #ffffff;
		}
	th, td {
		padding: 15px;
	}
</style>
</head>
<body>
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand"  href="monitor.php" target="_blank">Treasury</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="clerical.php">Home</a></li>
				<li><a href="#">Mails</a></li>
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
			<h2>Records</h2>
		</div>
		<div class="row">
			<table class="tablle table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="col-sm-1">Serial No.</th>
						<th class="col-sm-1">File No.</th>
						<th class="col-sm-2">Name(s) of Applicant</th>
						<th class="col-sm-3">Subject</th>
						<th class="col-sm-2">Date</th>
						<th class="col-sm-1">Shera</th>
						<th class="col-sm-1">Status</th>
						<th class="col-sm-1">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						//DATABASE CONNECTION
						include_once("connectivity.php");
						
						//SENDING QUERY
						$sql = "SELECT * FROM records WHERE userID='$userID'";
						$result = mysqli_query($conn, $sql);
						
						if(mysqli_num_rows($result) > 0 ) {
								
							//OUTPUT DATA FOR EACH ROW
							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr id='dataRow'>";
								echo "<td id='dataSerial'>".$row['serialNum'];
								$serialNum = $row['serialNum'];
								echo "<td id='dataFile'>".$row['fileNum'];
								echo "<td id='dataName'>".$row['name'];
								echo "<td id='dataSubject'>".$row['subject'];
								echo "<td id='dataDate'>".$row['date'];
								echo "<td id='dataShera'>".$row['shera'];
								echo "<td id='dataStatus'>".$row['status'];
								echo '<td><a href="clerkUpdate.php?serialNum='.$serialNum.'" class="btn btn-success" >Update</a></td>';
								echo "</tr>";
							}
							$conn -> close();
						}
						
					?>
				</tbody>
			</table>
		</div>	
	</div>
</body>
</html>