<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>

<body>
  <?php
  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "example2";

  $conn = mysqli_connect($host, $user, $password, $database);

  if (!$conn) {
    die('<div class="alert alert-warning" role="alert">Connection is failed with database</div>');
  } else {
    echo '<div class="alert alert-primary" role="alert">Connection is <strong>successfull</strong> done with database</div>';
  }
  $query = "SELECT * FROM `employee`";
  $sqlResult = mysqli_query($conn, $query);
  if (!$sqlResult) {
    die('<div class="alert alert-warning" role="alert">Sql query is failed</div>');
  } else {
    echo '<div class="alert alert-primary" role="alert">Sql query is <strong>successfull</strong> done </div>';
  }
  $numOfRow = mysqli_num_rows($sqlResult);

  if ($numOfRow > 0) {
    // for ($i = 1; $i <= $numOfRow; $i++) {
    //   $data = mysqli_fetch_assoc($sqlResult);
    //   echo "<br> " . var_dump($data);
    // }
  
    while ($row = mysqli_fetch_assoc($sqlResult)) {

      // echo "<br>" . var_dump($row);
      echo "<br>" . $row['SR No'] . " " . $row['Name'] . " " . $row['Salary'];
    }
  }
  ?>
</body>

</html>