<?php

$conn = mysqli_connect("localhost", "root", "", "treasury");

if(mysqli_connect_errno()) {
	echo"Unable to Connect " . mysqli_connect_error();
}
?>