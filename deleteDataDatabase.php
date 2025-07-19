<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "example2";

$conn = mysqli_connect($host, $user, $password, $database);
echo "Connect with database successfully done";
$name = "raj";
$query = "DELETE FROM `employee` WHERE `employee`.`Name` ='$name' LIMIT 3";
$sqlResult = mysqli_query($conn, $query);

echo "<br>SuccessFully deleted record of $name";
?>