<?php
session_start();

if (isset($_SESSION['username'])) {
  session_unset();
  session_destroy();
  echo "You logout successfully ";
} else {
  echo "you aleady log out";
}


?>