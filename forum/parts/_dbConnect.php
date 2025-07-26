<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "idiscuss";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
  echo "connection with database is failed " . mysqli_connect_error();
}

?>