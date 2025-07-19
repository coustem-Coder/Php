<?php
$student = [
  "name" => "nikunj",
  "age" => 18,
  "course" => "BCA"
];
echo "name : " . $student['name'];
echo "<br>Age : " . $student['age'];
echo "<br>course : " . $student['course'];

// for ($i = 0; $i < count($student); $i++) {
//   echo "<br>student[$i] : $student[1]";
// }

foreach ($student as $key => $value) {
  echo "<br>student[$key]= $value";
}
?>