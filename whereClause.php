<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "example2";

$conn = mysqli_connect($host, $user, $password, $database);

$query = "SELECT * FROM `employee` WHERE Dest='Bhavnagar'";
$sqlResult = mysqli_query($conn, $query);


$noOfRows = mysqli_num_rows($sqlResult);
echo "number of rows  in tabel in database : $noOfRows <br>";
// $row = mysqli_fetch_assoc($sqlResult);
// echo var_dump($row);

while ($row = mysqli_fetch_assoc($sqlResult)) {
  echo "<br>" . $row['SR No'] . " " . $row['Name'] . " " . $row['Salary'];
}
?>