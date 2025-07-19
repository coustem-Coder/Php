<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "example2";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
  echo "php to mySql connection is failed!!" . mysqli_connect_error($conn);
} else {
  echo "php to mySql connectoin is successfully done";
}

$sql = "CREATE TABLE `example2`.`employee` (`SR No` INT NOT NULL AUTO_INCREMENT , `Name` VARCHAR(11) NOT NULL , `Salart` INT NOT NULL , PRIMARY KEY (`SR No`))";

$sqlResult = mysqli_query($conn, $sql);
if ($sqlResult) {
  echo "<br>Table is success fully created in DataBase";
} else {
  echo "<br>Table is not created for some reason" . mysqli_error($conn);
}
?>