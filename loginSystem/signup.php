<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require "parts/_db_conn.php";
  $username = $_POST['username'];
  $password = $_POST['password'];
  $conPassword = $_POST['conPassword'];
  $exist = false;

  // echo "<br> username : $username";
  // echo "<br> pass : $password";
  // echo "<br> conPass : $conPassword";

  //verify user exixt already or not
  $exist_query = "SELECT * FROM `users_table` WHERE username='$username';";
  $exist_sqlResult = mysqli_query($conn, $exist_query);

  if (mysqli_num_rows($exist_sqlResult) == 1) {
    $exist = true;
    $_SESSION['alertType'] = "danger";
    $_SESSION['alertMessage'] = "singUp failed : Username is aleady exist!!";
  } else if ($password == $conPassword) { //if new user but verify pass and conpass is same or not

    $hashPassword = password_hash($password, PASSWORD_DEFAULT); //password conver into hasPass
    $query = "INSERT INTO `users_table` (`id`, `username`, `password`, `dt`) VALUES (NULL, '$username', '$hashPassword', current_timestamp())";
    $sqlResult = mysqli_query($conn, $query);

    $_SESSION['alertType'] = "success";
    $_SESSION['alertMessage'] = "Successfully singUp";

    $_SESSION['loggedIn'] = true;

    $_SESSION['username'] = $username;
    header("Location: /nikunj/loginSystem/welcome.php"); //redirected to welcome.php

    exit();
  } else {

    $_SESSION['alertType'] = "danger";
    $_SESSION['alertMessage'] = "singUp failed : Password do not match!!";

  }
  header("Location: " . $_SERVER['PHP_SELF']); //refresh page and clear form 

  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

  <style>
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  </style>
</head>

<body>
  <?php require "parts/_nav.php"; ?>
  <?php
  if (isset($_SESSION['alertType'])) {
    echo '<div class="alert alert-' . $_SESSION['alertType'] . ' alert-dismissible fade show" role="alert">'
      . $_SESSION['alertMessage'] . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    unset($_SESSION['alertType']);
    unset($_SESSION['alertMessage']);
  }
  ?>
  <div class="container mt-4 ">
    <h2 class="text-center">SignUp to our website</h2>
    <form action="/nikunj/loginSystem/signUp.php" method="POST">
      <div class="mb-3 col-md-6">
        <label for="username" class="form-label">Username</label>
        <input type="text" maxlength="11" name="username" class="form-control" id="username" required>
      </div>
      <div class="mb-3 col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" maxlength="11" name="password" class="form-control" id="password" required>
      </div>
      <div class="mb-3 col-md-6">
        <label for="conPassword" class="form-label">Confirm Password</label>
        <input type="password" maxlength="11" name="conPassword" class="form-control" id="conPassword" required>
        <div class="form-text">Make sure to type same password</div>
      </div>
      <button type="submit" class="btn btn-outline-primary col-md-6">SignUp</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>