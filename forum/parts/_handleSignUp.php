<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include "_dbConnect.php";

  $uname = $_POST['signup-username'];
  $pass = $_POST['signup-password'];
  $conPass = $_POST['signup-conPass'];


  $searchQuery = "SELECT * FROM `users` WHERE `username` LIKE '$uname'";
  $searchQueryResult = mysqli_query($conn, $searchQuery);

  //if user is already exist in database
  if (mysqli_num_rows($searchQueryResult) > 0) {
    $alert_type = "danger";
    $alert_msg = "Failed to signup : username is already exixt";

  }// entered password in not same as entered confirm password 
  else if ($pass != $conPass) {
    $alert_type = "danger";
    $alert_msg = "Failed to signup : Enter same password";
  }// if all condition is true then signup successfully in website or add information in database 
  else {
    $hashPass = password_hash($pass, PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO `users` (`user_id`, `username`, `password`, `login_time`) VALUES (NULL, '$uname', '$hashPass', current_timestamp());";

    $insertQueryResult = mysqli_query($conn, $insertQuery);
    $_SESSION['username'] = $uname;

    $searchQuery = "SELECT * FROM `users` WHERE `username` LIKE '$uname'";
    $searchQueryResult = mysqli_query($conn, $searchQuery);
    $user = mysqli_fetch_assoc($searchQueryResult);
    $_SESSION['userId'] = $user['user_id'];

    $alert_type = "success";
    $alert_msg = "SignUp Successfully";

  }

  header("Location: /nikunj/forum/index.php?alert_type=$alert_type&alert_msg=$alert_msg");

  exit();
}
?>