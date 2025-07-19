<?php
setcookie("username", "nikunj", time() + 1000);
setcookie("password", "nikunj15521H", time() + 1000);
echo "cookie is set";

echo "<br> cookie username " . $_COOKIE['username'];
echo "<br> cookie password " . $_COOKIE['password'];

?>