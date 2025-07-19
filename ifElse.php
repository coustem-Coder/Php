<?php
$a = 50;
$b = 10;
if ($a > $b) {
  echo "$a is greater than $b";
} elseif ($a == $b) {
  echo "$a is equal to $b";
} else {
  echo "$a is less than $b";
}
echo "<br>";
switch ($a) {
  case 10:
    echo "my age is 10";
    break;
  case 20:
    echo "my age is 20";
    break;
  case 50:
    echo "my age is 50";
    break;
  default:
    echo "Invalid age";
    break;
}

?>