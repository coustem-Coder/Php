<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "example 2";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
  die("connection is failed : " . mysqli_connect_error());
}
echo "Connection is successfuly done";


?>