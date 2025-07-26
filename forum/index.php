<?php
session_start();

// Set session only if not already set
if (!isset($_SESSION['alert-type']) && (isset($_GET['alert_type']) || isset($_POST['alert_msg']))) {
  $_SESSION['alert-type'] = $_GET['alert_type'] ?? $_POST['alert_type'];
  $_SESSION['alert-msg'] = $_GET['alert_msg'] ?? $_POST['signupMsgalert_msg'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iDiscuss - Coding Forum</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <?php
  include "parts/_header.php";
  ?>
  <?php
  if (isset($_SESSION['alert-type'])) {
    $alert_type = $_SESSION['alert-type'];
    $alert_msg = $_SESSION['alert-msg'];

    echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show" role="alert">
    ' . $alert_msg . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['alert-type']);
    unset($_SESSION['alert-msg']);

    // Redirect after 2 seconds
    echo '<script>
        setTimeout(() => {
            window.location.href = "index.php";
        }, 2000);
    </script>';
  }
  ?>

  <div class="container">
    <h1 class="text-center my-3">iDiscuss - Categories</h1>
    <div class="row">
      <?php
      require "parts/_dbConnect.php";

      $query = "SELECT * FROM `categories`";
      $sqlResult = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($sqlResult)) {
        echo '<div class="col-md-4  my-1">
              <div class="card" style="width: 18rem;">
                <img
                  src="https://images.unsplash.com/photo-1493119508027-2b584f234d6c?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                  class="card-img-top" alt="..." width="100">
                <div class="card-body">
                  <h5 class="card-title">' . $row['category_name'] . '</h5>
                  <p class="card-text">' . $row['category_desc'] . '</p>
                  <a href="threadList.php?catId=' . $row['category_id'] . '" class="btn btn-primary">View threads</a>
                </div>
              </div>
          </div>';
      }
      ?>

    </div>

  </div>


  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>