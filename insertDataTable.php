<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "example2";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
  die("Connection is failed");
}

$name = "raj";
$salary = 2000;
echo "connectino is successfully done";
$sql = "INSERT INTO `employee` (`SR No`, `Name`, `Salary`) VALUES (NULL,'$name', '$salary') LIMIT 3";
$sqlResult = mysqli_query($conn, $sql);

if ($sqlResult) {
  echo "<br>Insertion is successfully done name = $name salary = $salary";
} else {
  echo "<br>Insertion is failed" . mysqli_error($conn);
}
?>