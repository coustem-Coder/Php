<?php
session_start();

require "parts/_db_conn.php";

//if user is not login
if (!isset($_SESSION['username'])) {

  header("Location: /nikunj/loginSystem/login.php"); // redirected to login page

  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome <?php echo $_SESSION['username']; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .userNav {
      display: flex;
      flex-direction: row;
      gap: 0.5rem;
      align-items: center;
      justify-content: center;
      color: white;
      margin: 0 10px;
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
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Welcome to our website <?php echo $_SESSION['username']; ?></h4>
      <p>How are you ?</p>
      <hr>
      <p class="mb-0">Let's begin your journey with us.Or if you want to logOut than click
        <button class="btn btn-outline-danger" type="submit">
          <a class="nav-link" href="/nikunj/loginSystem/logout.php">LogOut</a>
        </button>
      </p>
    </div>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>