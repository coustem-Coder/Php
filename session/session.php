<?php
session_start();
if (isset($_SESSION['username'])) {
  echo "you aready login";
} else {
  $_SESSION['username'] = "nikunj";
  $_SESSION['password'] = "nikunj15521H";

  echo "you are login successfully";
}

?>