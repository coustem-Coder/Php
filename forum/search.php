<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iDiscuss - Search</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php
  include "parts/_dbConnect.php";
  ?>
  <?php
  include "parts/_header.php";
  ?>
  <?php
  $search = $_GET['search'];

  ?>
  <div class="container">
    <h1 class="text-center my-4">Search result for <i><?php echo $search; ?></i></h1>
    <?php

    include "parts/_timeAgo.php";

    $searchThreadQuery = "SELECT * FROM `threads` WHERE `thread_title` LIKE '$search'";
    $searchThreadQueryResult = mysqli_query($conn, $searchThreadQuery);
    $isFound = false;

    while ($row = mysqli_fetch_assoc($searchThreadQueryResult)) {
      $isFound = true;
      $agoTime = timeAgo($row['timestamp']);

      //for find the user who post thread or question
    
      $threadUserId = $row['thread_user_id'];
      $searchUserQuery = "SELECT * FROM `users` WHERE `user_id` = $threadUserId";

      $searchResult = mysqli_query($conn, $searchUserQuery);
      $userRow = mysqli_fetch_assoc($searchResult);
      $userName = $userRow['username'];

      echo '<div class="d-flex align-items-start mb-4 my-3">
          <img
            src="https://png.pngtree.com/png-vector/20191027/ourlarge/pngtree-user-icon-isolated-on-abstract-background-png-image_1875037.jpg"
            class="me-3 rounded" alt="Profile Image" width="50px">
          <div class="flex-grow-1">
            <div class="d-flex justify-content-between">
              <h5 class="mt-0 mb-1">' . $userName . '</h5>
              <small class="text-muted">' . $agoTime . '</small>
            </div>
            <p class="mb-0"><a href="thread.php?threadId=' . $row['thread_id'] . '&threadUserName=' . $userName . '">' . $row['thread_title'] . '</a></p>
          </div>
        </div>
        <hr>';

    }
    ?>
    <?php
    if (!$isFound) {
      echo '<div class="container ">
    <div class="container-fluid py-4 text-center bg-light rounded-3">
      <h1 class="display-4">No Result Found</h1>
      <p class="lead text-xxl-center">Be the first person to ask question</p>

  </div>
  </div>';
    }
    ?>

  </div>


  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>