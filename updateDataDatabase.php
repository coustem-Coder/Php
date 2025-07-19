<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "example2";

$conn = mysqli_connect($host, $user, $password, $database);

echo "Connect with database successfully done";

$oldName = "gohel";
$newName = "kumar";
$query = "UPDATE `employee` SET `Name` = '$newName' WHERE `employee`.`Name` = '$oldName';";
$sqlResult = mysqli_query($conn, $query);

$numOfRowsAffect = mysqli_affected_rows($conn);
echo "<br>query sql command run successfully $oldName to $newName";
echo "<br>$numOfRowsAffect no of rows affected in our database";

?>