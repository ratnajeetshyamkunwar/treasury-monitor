<?php 
	error_reporting(0);
	session_start();
	
	$role = $_SESSION['role'];
	if(!isset($_SESSION['Serial']) && $role!="postclerk")  {
		header('location: login.php');
		die();
	} else {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['UserID'];
		$role = "postclerk";
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
<title>Mails Records</title>
<style>
	.white, .white a{
		color: #ffffff;
		}
	th, td {
		padding: 15px;
	}
	@media only print {
		.nav, .btn-print, .action, #col-action { display: none; }
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
				<li><a href="clerkProfile.php" ><span class="glyphicon glyphicon-user"> </span><?php echo " $userID"; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout</a>
			</ul>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row" style="margin:20px;">
			<h2>Mails</h2>
		</div>
		<div class="row" style="margin:20px;">
			<table class="tablle table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="col-sm-1">Serial No.</th>
						<th class="col-sm-1">Name</th>
						<th class="col-sm-1">Address</th>
						<th class="col-sm-1">Name and No. of Compilation</th>
						<th class="col-sm-1">Date(Sent)</th>
						<th class="col-sm-1">Date(Receive)</th>
						<th class="col-sm-2">Subject</th>
						<th class="col-sm-1">Outward Checking No.</th>
						<th class="col-sm-1">Classification</th>
						<th class="col-sm-1">Shera</th>
						<th class="col-sm-1" id="col-action">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						//DATABASE CONNECTION
						include_once("connectivity.php");
						
						//SENDING QUERY
						$sql = "SELECT * FROM mails WHERE userID='$userID'";
						$result = mysqli_query($conn, $sql);
						
						if(mysqli_num_rows($result) > 0 ) {
								
							//OUTPUT DATA FOR EACH ROW
							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>" .$row['serialNum'];
								$serialNum = $row['serialNum'];
								echo "<td>" .$row['name'];
								echo "<td>" .$row['address'];
								echo "<td>" .$row['compilation'];
								echo "<td>" .$row['dateSent'];
								echo "<td>" .$row['dateReceive'];
								echo "<td>" .$row['subject'];
								echo "<td>" .$row['checkNum'];
								echo "<td>" .$row['classification'];
								echo "<td>" .$row['shera'];
								echo '<td class="action"><a href="mailUpdate.php?serialNum='.$serialNum.'" class="btn btn-success" >Update</a></td>';
								echo "</tr>";
							}
							
						}$conn -> close();
						
					?>
				</tbody>
			</table>
		</div>
		<div class="btn-print navbar-right" style="margin-top: 50px;">
			<button class="btn btn-primary" onclick="printPages()"><span class="glyphicon glyphicon-print"> </span> PRINT</button>
		</div>
	</div>
	<script>
		function printPages(){
			window.print();
		}
	</script>
</body>
</html>
