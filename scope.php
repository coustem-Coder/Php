<?php
$a = 55;
function showA()
{
  global $a;
  $a = 99;
  echo "<br> inside of fun a = $a";
}
echo "out side of fun a = $a";

showA();
//  {
//   $a = 10;
//   echo "<br>inside block a = $a";
// }
echo "<br>out side of fun a = $a";

echo "<br>GLOBALS : " . var_dump($GLOBALS["a"]);
?>