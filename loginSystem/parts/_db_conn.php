<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "user";

$conn = mysqli_connect($host, $user, $password, $database);


if (!$conn) {
  die("error") . mysqli_connect_error();

}
?>