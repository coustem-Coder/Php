<?php
include "parts/_dbConnect.php";
session_start();
// Unified way to fetch catId safely
$catId = $_GET['catId'] ?? $_POST['catId'] ?? null;


if (!$catId) {
  die("Invalid category ID.");
}

// Insert new thread if form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // $userId = $_GET['userId'] ?? $_POST['userId'] ?? null;
  $userId = $_POST['userId'];
  $threadTitle = $_POST['threadTitle'] ?? '';
  $threadTitle = str_replace("<", "&lt;", $threadTitle);
  $threadTitle = str_replace(">", "&gt;", $threadTitle);
  $threadDec = $_POST['threadDec'] ?? '';
  $threadDec = str_replace("<", "&lt;", $threadDec);
  $threadDec = str_replace(">", "&gt;", $threadDec);

  //insert thread into database
  $insertThreadQuery = "INSERT INTO `threads` 
    (`thread_id`, `thread_title`, `thread_dec`, `thread_user_id`, `timestamp`, `thread_cat_id`) 
    VALUES (NULL, '$threadTitle', '$threadDec', '$userId', current_timestamp(), '$catId')";

  $insertThreadQueryResult = mysqli_query($conn, $insertThreadQuery);

  $_SESSION['alert_type'] = "success";
  $_SESSION['alert_message'] = "Your question successfully submitted";

  header("Location: threadList.php?catId=" . $catId); // website refesh or form refresh with catid
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iDiscuss - ThreadsList</title>
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

  if (isset($_SESSION['alert_type'])) {
    $alert_type = $_SESSION['alert_type'];
    $alert_msg = $_SESSION['alert_message'];
    echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show" role="alert">
  ' . $alert_msg . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    unset($_SESSION['alert_type']);
    unset($_SESSION['alert_message']);
  }

  ?>
  <!-- show category in detail -->
  <?php
  $catId = $_GET['catId'];
  $searchQuery = "SELECT * FROM `categories` WHERE `category_id` = $catId";
  $searchQueryResult = mysqli_query($conn, $searchQuery);
  $row = mysqli_fetch_assoc($searchQueryResult);
  ?>
  <!-- category tread and questios page -->
  <div class="container ">
    <div class="container-fluid py-5 text-center bg-light rounded-3">
      <h1 class="display-4">Welcome to <?php echo strtoupper($row['category_name']); ?> Threads!</h1>
      <p class="lead text-xxl-start"><?php echo $row['category_desc']; ?></p>
      <hr class="my-4">
      <p>A peer-to-peer forum website thrives on mutual respect, constructive discussion, and meaningful engagement.
        Users
        should stay on topic, avoid spam or promotions, use clear language, and respect others’ privacy. Posts should be
        helpful, civil, and relevant, and moderation ensures fairness by addressing violations like harassment or
        misinformation. Thoughtful contributions and proper tagging make forums more welcoming and informative for
        everyone.
      </p>
    </div>

  </div>

  <!-- form to ask question -->
  <div class="container my-5">
    <h1>Ask Questions</h1>
    <?php
    // if user is logged in then they post their questions (show form)
    if (isset($_SESSION['username'])) {
      //fetch session data that enter time in login or signUp
      $userId = $_SESSION['userId'];
      echo '<form action="threadList.php?catId=' . $catId . ' " method="POST">
  <div class="my-3">
    <label for="threadTitle" class="form-label">Problem Title</label>
    <input type="text" class="form-control" id="threadTitle" aria-describedby="emailHelp" name="threadTitle">
    <div id="emailHelp" class="form-text">Ask short and crespy question about problems</div>
  </div>
  <div class="form-floating">
    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
      name="threadDec"></textarea>
    <label for="floatingTextarea2">Problem In detail</label>
  </div>
  <input type="hidden" name="userId" value="' . $userId . '">
  <input type="hidden" name="catId" value="' . htmlspecialchars($catId) . '">

  <button type="submit" class="btn btn-primary my-3">Ask Question</button>
</form>';

      // if user is not logged in then they can not post their questions (hide form and show alert)
    } else {
      echo '<div class="alert alert-warning" role="alert">
      <h4 class="alert-heading">Hold on! 🚫</h4>
      <hr>
      <p>
        You must be logged in to post something.
        Login or create an account to continue.</p>

    </div>';
    } ?>


  </div>


  <!-- the question show that ask by users about category -->
  <div class="container">
    <h1 class="my-5">Browse questions</h1>
    <?php

    include "parts/_timeAgo.php";

    $searchThreadQuery = "SELECT * FROM `threads` WHERE `thread_cat_id` = $catId";
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
            <p class="mb-0"><a href="thread.php?threadId=' . $row['thread_id'] . '">' . $row['thread_title'] . '</a></p>
          </div>
        </div>
        <hr>';

    }


    //  <p>' . $row['thread_dec'] . '</p>
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



  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>