<?php
session_start();
$commentId = $_GET['comment_id'];
echo $commentId;
require "parts/_dbConnect.php";
$threadId = $_GET['threadId'] ?? $_POST['threadId'] ?? null;

$deleteQuery = "DELETE FROM `comments` WHERE `comments`.`comment_id` = $commentId";
$deleteResult = mysqli_query($conn, $deleteQuery);
if ($deleteResult) {
  $_SESSION['alert_type'] = 'success';
  $_SESSION['alert_msg'] = "Delete Successfully";
} else {
  $_SESSION['alert_type'] = 'danger';
  $_SESSION['alert_msg'] = "Delete UnSuccessfully";
}
header("Location: thread.php?threadId=$threadId");
?>