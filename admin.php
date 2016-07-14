<?php
	error_reporting(0);
	session_start();
	
	$role = $_SESSION['role'];
	if(!isset($_SESSION['Serial']) && $role!="admin")  {
		header('location: login.html');
		die();
	} else {
		$serial = $_SESSION['Serial'];
		$userID = $_SESSION['username'];
		$role = "admin";
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
<title>Admin</title>
<style>
	p{
		line-height: 2;
	}
	.affix{
		top: 20px;
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
				<li><a href="admin.php">Home</a></li>
				<li><a href="viewMails.php">Mails</a></li>
				<li><a href="viewRecords.php">Records</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="adminProfile.php" ><span class="glyphicon glyphicon-user"> </span><?php echo " $userID"; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout</a>
			</ul>
		</div>
	</nav>
	<div class="container-fluid" style="margin: 20px;">
		<div class="row">
			<div class="col-sm-3" style="background-color: #f1f1f1;margin-top: 70px;">
				<div class="modal-header">
					<h3>About</h3>
				</div>
				<h4>Activation Status</h4>
				<div class="panel-body">
					<p>Activation status <strong>'1'</strong> signifies that the account is active. Similarly,
					 <strong>'0'</strong> signifies deactivated account.</p>
				</div>
					
				<h4>Actions</h4>
				<div class="panel-body">
					<p>Press <button class="btn btn-xs btn-success"> Activate</button> button to Activate a deactivate account.</p>
					<p>press <button class="btn btn-xs btn-danger"> Deactivate</button> button to Deactivate an Activated account.</p>
					<p>Press <button class="btn btn-xs btn-info"> Reset Password</button> button to reset the password to default value.</p>
					<br>
					
					<p>Click on your <a>userID</a> on top right side of the window in navigation bar to view and update your profile
					information</p>
					<p>Click on <a>logout</a> to close the session.</p>
				</div>
			</div>
			<div class="col-sm-9">
				<h3 class="modal-header">Post Clerks</h3>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="">Serial No.</th>
							<th class="">Department</th>
							<th class="">User ID</th>
							<th class="">Password</th>
							<th class="">Activation Status</th>
							<th class="">Action</th>
						</tr>
					</thead>
					<tbody>
			<?php 
				include_once("connectivity.php");
				
				//sending query
				$sql = "SELECT * FROM postclerk";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($result) > 0)
				{
					//output data for each row
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" .$row["Serial"]. "</td>";
						$serialNum = $row["Serial"];
						echo "<td>" .$row["Department"]. "</td>";
						echo "<td>" .$row["UserID"]. "</td>";
						echo "<td>" .$row["Password"]. "</td>";
						echo "<td>" .$row["Activate"]. "</td>";
						echo '<td> <a class="btn btn-success" href="postClerkActivate.php?serialNum='.$serialNum.'">Activate</a>';
						echo ' <a class="btn btn-danger" href="postClerkDeactivate.php?serialNum='.$serialNum.'">Deactivate</a>';
						echo ' <a class="btn btn-info" href="postClerkPasswordReset.php?serialNum='.$serialNum.'">Reset Password</a></td>';
						echo "</tr>";
					}
				
				}else {
					echo "0 result";
				}
			?>
				</tbody>
				</table>
				<h3 class="modal-header">Clerks</h3>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="">Serial No.</th>
							<th class="">Department</th>
							<th class="">User ID</th>
							<th class="">Password</th>
							<th class="">Activation Status</th>
							<th class="">Action</th>
						</tr>
					</thead>
					<tbody>
			<?php 
					
				//sending query
				$sql = "SELECT * FROM Members";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($result) > 0)
				{
					//output data for each row
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" .$row["Serial"]. "</td>";
						$serialNum = $row["Serial"];
						echo "<td>" .$row["Department"]. "</td>";
						echo "<td>" .$row["UserID"]. "</td>";
						echo "<td>" .$row["Password"]. "</td>";
						echo "<td>" .$row["Activate"]. "</td>";
						echo '<td> <a class="btn btn-success" href="userActivate.php?serialNum='.$serialNum.'">Activate</a>';
						echo ' <a class="btn btn-danger" href="userDeactivate.php?serialNum='.$serialNum.'">Deactivate</a>';
						echo ' <a class="btn btn-info" href="resetUserPassword.php?serialNum='.$serialNum.'">Reset Password</a></td>';
						echo "</tr>";
					}
				
				}else {
					echo "0 result";
				}
				$conn->close();
			?>
					</tbody>
				</table>
			</div>
	</div>

</body>
</html>