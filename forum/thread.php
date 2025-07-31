<?php
include "parts/_dbConnect.php";

session_start();

$threadId = $_GET['threadId'] ?? $_POST['threadId'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $comment = $_POST['comment'];
  $comment = str_replace("<", "&lt;", $comment);
  $comment = str_replace(">", "&gt;", $comment);

  $uname = $_SESSION['username'];

  $userId = $_SESSION['userId'];
  // insert comment

  $insertCommentQuery = "INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_thread_id`, `comment_time`,`comment_user_id`) VALUES (NULL, '$comment', '$threadId', current_timestamp(),'$userId');";
  $insertCommetResult = mysqli_query($conn, $insertCommentQuery);

  $_SESSION['alert_type'] = "success";
  $_SESSION['alert_msg'] = "Your comment has been successfully posted";

  header("Location: thread.php?threadId=" . $threadId);
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iDiscuss - Thread</title>
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
  include "parts/_dbConnect.php";
  ?>
  <?php
  if (isset($_SESSION['alert_type'])) {
    $alert_type = $_SESSION['alert_type'];
    $alert_msg = $_SESSION['alert_msg'];
    echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show" role="alert">
    ' . $alert_msg . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    unset($_SESSION['alert_type']);
    unset($_SESSION['alert_msg']);
  }
  ?>
  <?php
  $threadId = $_GET['threadId'];

  $searchQuery = "SELECT * FROM `threads` WHERE `thread_id` = $threadId";
  $searchQueryResult = mysqli_query($conn, $searchQuery);

  while ($row = mysqli_fetch_assoc($searchQueryResult)) {
    //fetch username who post question
    $threadUserId = $row['thread_user_id'];
    $searchUserQuery = "SELECT * FROM `users` WHERE `user_id` = $threadUserId";
    $searchUserResult = mysqli_query($conn, $searchUserQuery);
    $userRow = mysqli_fetch_assoc($searchUserResult);
    $threadUserName = $userRow['username'];
    echo '  <div class="container ">
    <div class="container-fluid py-5 text-center bg-light rounded-3">
      <h1 class="display-4">Question : ' . strtoupper($row['thread_title']) . '</h1>
      <p class="lead text-xxl-center">Question Desctription : ' . $row['thread_dec'] . '</p>
      <hr class="my-4">
      <p>A peer-to-peer forum website thrives on mutual respect, constructive discussion, and meaningful engagement. Users should stay on topic, avoid spam or promotions, use clear language, and respect others’ privacy. Posts should be helpful, civil, and relevant, and moderation ensures fairness by addressing violations like harassment or misinformation. Thoughtful contributions and proper tagging make forums more welcoming and informative for everyone.
      </p>
        
      <p class="text-left">Posted by <strong>' . $threadUserName . '</strong></p>
  </div>
  </div>';
  }

  ?>
  <div class="container">
    <h1>Discussion</h1>
    <?php
    // if user is logged in then they post their comment (show form)
    if (isset($_SESSION['username'])) {
      echo '    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
      + Add Comment
    </button>';
    } else {
      // if user is not logged in then they can not post their comment (hide form)
      echo '<div class="alert alert-warning" role="alert">
      <h4 class="alert-heading">Hold on! 🚫</h4>
      <hr>
      <p>
        You must be logged in to post something.
        Login or create an account to continue.</p>

    </div>';
    }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Comment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- comment form -->
            <form action="thread.php?threadId=<?php echo $threadId; ?>" method="POST">
              <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                  style="height: 100px" name="comment"></textarea>
                <label for="floatingTextarea2">Leave a comment here</label>
              </div>
              <button type="submit" class="btn btn-primary my-3">+Add Comment</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>

    <?php
    include "parts/_timeAgo.php";

    $isFound = false;
    $searchCommentQuery = "SELECT * FROM `comments` WHERE `comment_thread_id` = $threadId";
    $searchCommentResult = mysqli_query($conn, $searchCommentQuery);

    if ($searchCommentResult && mysqli_num_rows($searchCommentResult) > 0) {
      $isFound = true;

      while ($row = mysqli_fetch_assoc($searchCommentResult)) {

        //for find the user who post thread or question
    
        $agoTime = timeAgo($row['comment_time'], true);
        $commentUserId = $row['comment_user_id'];
        $commentId = $row['comment_id'];

        $searchUserQuery = "SELECT * FROM `users` WHERE `user_id` = $commentUserId";
        $searchUserResult = mysqli_query($conn, $searchUserQuery);
        $userRow = mysqli_fetch_assoc($searchUserResult);
        $commentUserName = $userRow['username'];

        echo '<div class="d-flex align-items-start mb-4 my-3">
        <img
        src="https://png.pngtree.com/png-vector/20191027/ourlarge/pngtree-user-icon-isolated-on-abstract-background-png-image_1875037.jpg"
        class="me-3 rounded" alt="Profile Image" width="50px">
        <div class="flex-grow-1">
                <div class="d-flex justify-content-between">
                  <h5 class="mt-0 mb-1">' . $commentUserName . '</h5>
                  <small class="text-muted">' . $agoTime . '</small>
                  </div>
                  <p class="mb-0">' . $row['comment_content'] . '</p>
                  </div>
                  </div>';
        if (isset($_SESSION['username'])) {
          if ($commentUserName == $_SESSION['username']) {

            echo ' <a href="deleteComment.php?comment_id=' . $commentId . '&threadId=' . $threadId . '">
                      <div class="btn btn-sm btn-danger">Delete Comment</div>
                    </a>';
          }
        }
        echo '<hr>';

      }
    }

    ?>

    <?php
    if (!$isFound) {
      echo '<div class="container ">
    <div class="container-fluid py-4 text-center bg-light rounded-3">
      <h1 class="display-4">No Comment Found</h1>
      <p class="lead text-xxl-center">Be the first person to post comment</p>

  </div>
  </div>';
    }
    ?>
  </div>

  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>