<?php
$con = mysqli_connect("localhost", "root", "", "umkm_teniga");


// Check connection
if ($con->connect_errno) {
  echo "Failed to connect to MySQL: " . $con->connect_error;
  exit();
}
?>