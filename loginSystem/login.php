<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require "parts/_db_conn.php";
  $username = $_POST['username'];
  $password = $_POST['password'];

  // echo "<br> username : $username";
  // echo "<br> pass : $password";

  $hashPassword = password_hash($password, PASSWORD_DEFAULT); // user enter password convert into hashPass
  // $query = "SELECT * FROM `users_table` WHERE username='$username' AND password='$hashPassword';";
  $query = "SELECT * FROM `users_table` WHERE username='$username';";
  $sqlResult = mysqli_query($conn, $query);

  $row = mysqli_fetch_assoc($sqlResult);
  //check if user exist and only one exist and password verify userEnter and dataBase HashPass
  if (mysqli_num_rows($sqlResult) == 1 and password_verify($password, $row['password'])) {

    $_SESSION['alertType'] = "success";
    $_SESSION['alertMessage'] = "Successfully Login";

    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = $username;
    header("Location: /nikunj/loginSystem/welcome.php");

    exit();

  } else {
    $_SESSION['alertType'] = "danger";
    $_SESSION['alertMessage'] = "Failed to login : <strong>Incorrect username or password </strong>";

    header("Location: " . $_SERVER['PHP_SELF']);

  }

  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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

    <h2 class="text-center">Login to our website</h2>
    <form action="/nikunj/loginSystem/login.php" method="POST">
      <div class="mb-3 col-md-6">
        <label for="username" class="form-label">Username</label>
        <input type="text" maxlength="11" name="username" class="form-control" id="username" required>
      </div>
      <div class="mb-3 col-md-6">
        <label for="password" class="form-label" required>Password</label>
        <input type="password" maxlength="11" name="password" class="form-control" id="password" required>
      </div>

      <button type="submit" class="btn btn-outline-primary col-md-6">Login</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>