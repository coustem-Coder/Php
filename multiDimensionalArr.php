<?php
$arr = array(
  array(1, 2, 3),
  array(4, 5, 6),
  array(7, 8, 9)
);
echo var_dump($arr);

// foreach ($arr as $i => $value) {
//   echo "<br>arr[$i] = ";
//   foreach ($arr[$i] as $j => $value2) {
//     echo " $value2";
//   }
// }

for ($i = 0; $i < count($arr); $i++) {
  echo "<br>arr[$i] = ";
  for ($j = 0; $j < count($arr[$i]); $j++) {
    echo " " . $arr[$i][$j];
  }
}

?>