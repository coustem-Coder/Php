<?php
$host = "localhost";
$username = "root";
$password = "";


$conn = mysqli_connect($host, $username, $password);

if (!$conn) {
  die("Connection is failed : " . mysqli_connect_error());
}
echo "connection Successfully done";


$sql = "CREATE DATABASE example4";
$sqlResult = mysqli_query($conn, $sql);

if ($sqlResult) {
  echo "<br>Database is successfully created";
} else {
  echo "<br>Database is not created!! " . mysqli_error($conn);
}
?>