<?php
session_start();
if (isset($_SESSION['username'])) {
  unset($_SESSION['username']);
  $alert_type = "success";
  $alert_msg = "You has been successfully logOut";
  header("Location: index.php?alert_type=$alert_type&alert_msg=$alert_msg");
  exit();
}
?>