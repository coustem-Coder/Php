<?php
// function processMarks($marksArr)
// {
//   $sum = 0;
//   foreach ($marksArr as $i => $value) {
//     echo "subject $i : $value <br>";
//     $sum += $value;
//   }
//   return $sum;
// }

$processMarks = function ($marksArr) {
  $sum = 0;
  foreach ($marksArr as $i => $value) {
    echo "subject $i : $value <br>";
    $sum += $value;
  }
  return $sum;
};
$marksArr = array(50, 40, 20, 10, 50, 80);
$totalMarks = $processMarks($marksArr);


echo "Total marks : $totalMarks out of 600";


?>