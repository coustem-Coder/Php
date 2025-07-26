<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  include "_dbConnect.php";
  $uname = $_POST['login-username'];
  $pass = $_POST['login-password'];

  $searchQuery = "SELECT * FROM `users` WHERE `username` LIKE '$uname'";
  $searchResult = mysqli_query($conn, $searchQuery);
  if (mysqli_num_rows($searchResult) > 0) {
    $user = mysqli_fetch_assoc($searchResult);
    if (password_verify($pass, $user['password'])) {
      $_SESSION['username'] = $uname;
      $_SESSION['userId'] = $user['user_id'];
      $alert_type = "success";
      $alert_msg = "Login Successfully";
    } else {
      $alert_type = "danger";
      $alert_msg = "Login Failed : password is inccorect";

    }
  } else {
    $alert_type = "danger";
    $alert_msg = "Login Failed : User not found ";
  }
  header("Location: /nikunj/forum/index.php?alert_type=$alert_type&alert_msg=$alert_msg");
  exit();
}
?>