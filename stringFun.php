<?php
$name = "my name is nikunj";
$surName = "gohel";
$string = "how are you";
echo "<br>";
echo "$name";
echo "<br>";
echo strlen($name);
echo "<br> my name is " . $name . " " . $surName; // concinate two string usgin .dot operator
echo "<br> length of name : " . strlen($name);
echo "<br> count of words in string_var : " . str_word_count($string);

echo "<br> reverse of string : " . strrev($string); // only for print reverse not affect on value of string
echo "<br> before reverse of string : $string";
$string = strrev($string); // if we want to chane value of string to reverse 
echo "<br> after reverse of string : $string";
$string = strrev($string);

echo "<br> are position in str : " . strpos($string, "how");
$string = str_replace("are", "is", subject: $string);
echo "<br> String is : $string";

echo "<br> repeat string 10 times : " . str_repeat($string, 10);

echo "<br>";
echo "<pre>";
echo rtrim("     hello my name       ");
echo "</pre>";
?> 