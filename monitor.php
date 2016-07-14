
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<title>Treasury Monitor</title>
<style>
	th, td {
		padding: 15px;
	}
	.nav-pills{
		font-size: 20px;
		}
	@media only print {
		.nav, .nav-pills { display:none;}
	}
</style>
</head>
<body>
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="monitor.php">Treasury</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php" target="_blank"><span class="glyphicon glyphicon-log-in"> </span> Login</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
		<div class="modal-header" style="margin-bottom: 20px;">
			<h2>Monitor</h2>
		</div>
		<ul class="nav nav-pills nav-justified">
			<li class="active"><a data-toggle="pill" href="#audit">Audit</a></li>
			<li><a data-toggle="pill" href="#compilation">Compilation</a></li>
			<li><a data-toggle="pill" href="#establishment">Establishment</a></li>
			<li><a data-toggle="pill" href="#pension">Pension</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="audit">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Username</th>
							<th>Pending Files</th>
						</tr>
					</thead>
					<tbody>
							<?php 
								include_once('connectivity.php');
								
								$sql = "SELECT Serial, UserID FROM members WHERE Department='Audit'";
								
								$result = mysqli_query($conn, $sql);
								
								if(mysqli_num_rows($result) > 0) {
									
									while($row = mysqli_fetch_assoc($result)) {
										echo "<tr>";
										echo "<td>" .$row['Serial'];
										echo "<td>" .$row['UserID'];
										$user = $row['UserID'];
										$sql2 ="SELECT * FROM records WHERE status='Unprocessed' AND userID = '$user'";
										
										if ($result2=mysqli_query($conn,$sql2))
										{
											// Return the number of rows in result set
											$rowcount=mysqli_num_rows($result2);
											// Free result set
											mysqli_free_result($result2);
										}
										echo "<td>" .$rowcount;
										echo "</tr>";
									}
								}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade in" id="compilation">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Username</th>
							<th>Pending Files</th>
						</tr>
					</thead>
					<tbody>
							<?php 
								
								$sql = "SELECT Serial, UserID FROM members WHERE Department='compilation'";
								
								$result = mysqli_query($conn, $sql);
								
								if(mysqli_num_rows($result) > 0) {
									
									while($row = mysqli_fetch_assoc($result)) {
										echo "<tr>";
										echo "<td>" .$row['Serial'];
										echo "<td>" .$row['UserID'];
										$user = $row['UserID'];
										$sql2 ="SELECT * FROM records WHERE status='Unprocessed' AND userID = '$user'";
										
										if ($result2=mysqli_query($conn,$sql2))
										{
											// Return the number of rows in result set
											$rowcount=mysqli_num_rows($result2);
											// Free result set
											mysqli_free_result($result2);
										}
										echo "<td>" .$rowcount;
										echo "</tr>";
									}
								}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade in" id="establishment">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Username</th>
							<th>Pending Files</th>
						</tr>
					</thead>
					<tbody>
							<?php 
								
								$sql = "SELECT Serial, UserID FROM members WHERE Department='establishment'";
								
								$result = mysqli_query($conn, $sql);
								
								if(mysqli_num_rows($result) > 0) {
									
									while($row = mysqli_fetch_assoc($result)) {
										echo "<tr>";
										echo "<td>" .$row['Serial'];
										echo "<td>" .$row['UserID'];
										$user = $row['UserID'];
										$sql2 ="SELECT * FROM records WHERE status='Unprocessed' AND userID = '$user'";
										
										if ($result2=mysqli_query($conn,$sql2))
										{
											// Return the number of rows in result set
											$rowcount=mysqli_num_rows($result2);
											// Free result set
											mysqli_free_result($result2);
										}
										echo "<td>" .$rowcount;
										echo "</tr>";
									}
								}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade in" id="pension">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Username</th>
							<th>Pending Files</th>
						</tr>
					</thead>
					<tbody>
							<?php 
								
								$sql = "SELECT Serial, UserID FROM members WHERE Department='Pension'";
								
								$result = mysqli_query($conn, $sql);
								
								if(mysqli_num_rows($result) > 0) {
									
									while($row = mysqli_fetch_assoc($result)) {
										echo "<tr>";
										echo "<td>" .$row['Serial'];
										echo "<td>" .$row['UserID'];
										$user = $row['UserID'];
										$sql2 ="SELECT * FROM records WHERE status='Unprocessed' AND userID = '$user'";
										
										if ($result2=mysqli_query($conn,$sql2))
										{
											// Return the number of rows in result set
											$rowcount=mysqli_num_rows($result2);
											// Free result set
											mysqli_free_result($result2);
										}
										echo "<td>" .$rowcount;
										echo "</tr>";
									}
								}
								$conn->close();
							?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		</div>
		<div>
			<p>Click on this button to print this page</p>
			<button onclick="printFunction()">Print</button>
		</div>
	</div>
	<script>
		function printFunction() {
			window.print();
		}
	</script>
</body>
</html>
	