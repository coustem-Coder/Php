<?php
session_start();

//if user exist
if (isset($_SESSION['username'])) {
  unset($_SESSION['username']);
  unset($_SESSION['loggedIn']);
  $_SESSION['alertType'] = "success";
  $_SESSION['alertMessage'] = "Successfully logOut ";
  header("Location: /nikunj/loginSystem/login.php");
  exit();

}
//  else {
//   $_SESSION['alertType'] = "warning";
//   $_SESSION['alertMessage'] = "You already logOut : First you need to " .
//     '<button class="btn btn-outline-primary">
//    <a class="nav-link" href="/loginSystem/login.php">Login</a>
//         </button>'
//     . " or " .
//     '<button class="btn btn-outline-primary">
//    <a class="nav-link" href="/loginSystem/signUp.php">SignUp</a>
//         </button>';
//   exit();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LogOut</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>

<body>

  <?php require "parts/_nav.php"; ?>

  <div class="container my-3">
    <?php
    if (isset($_SESSION['alertType'])) {
      echo '<div class="alert alert-' . $_SESSION['alertType'] . '" role="alert">
  <h4 class="alert-heading">' . $_SESSION['alertMessage'] . '</h4>
</div>';
      unset($_SESSION['alertType']);
      unset($_SESSION['alertMessage']);
    }
    ?>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>