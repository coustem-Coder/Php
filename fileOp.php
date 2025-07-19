<?php
// $data = readfile("myfile.txt");
// readfile("myfile.txt");
// readfile("apel_aja.jpg");

// readfile("phpProject/index.php");

$fptr = fopen("myfile.txt", "w+");
echo $fptr;
// echo var_dump($fptr);


//reading whole file at  time
// $content = fread($fptr, filesize("myfile.txt")); 
// echo "content : $content";

//reading file  line by line
// $line = fgets($fptr);
// echo fgets($fptr) . "<br>";
// echo fgets($fptr) . "<br>";
// echo fgets($fptr) . "<br>";
// echo fgets($fptr) . "<br>";

// while ($line = fgets($fptr)) {
//   echo "$line <br>";
// }

//reading file character by character
// while ($ch = fgetc($fptr)) {
//   echo $ch;
//   if ($ch == "\n") {
//     echo "<br>";
//   }
// }

//writting in file 


fwrite($fptr, "content 1\n");
fwrite($fptr, "content 2\n");
fwrite($fptr, "content 3\n");


// special shortcut methods of file
// $content = file_get_contents("myfile.txt");

// file_put_contents("myfile.txt", "you are so beautifull");
// file_put_contents("myfile.txt", " you are so ugly", FILE_APPEND);

// echo $content;


//delete file
// unlink("deletFile.txt");

//check if file is existed and yes than return true else blank
// if (!(file_exists("deletFile.txt"))) {
//   echo "file is not exixt";
// }

echo "<br> File last modified time : " . filemtime("loop.php");
echo "<br> File last accessed time : " . fileatime("loop.php");
echo "<br> File type : " . filetype("phpProject");

$fileMetadataArr = stat("myfile.txt");

echo "<br> file metadata stat arr : " . var_dump($fileMetadataArr);

fclose($fptr);
?>