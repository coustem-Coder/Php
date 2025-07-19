<?php
session_start();

echo "welcome " . $_SESSION['username'];
echo " your password " . $_SESSION['password'];
?>