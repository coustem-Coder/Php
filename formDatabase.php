<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>form to database</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container sm">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $pass = $_POST["password"];

      $alert = '<div class="alert alert-success" role="alert"> Successfully login as ' . $email . '</div>';
      echo $alert;

      $host = "localhost";
      $user = "root";
      $password = "";
      $database = "login";

      $conn = mysqli_connect($host, $user, $password, $database);

      if (!$conn) {
        die('<div class="alert alert-danger" role="alert">
  Cannnot connect with database!!
</div>');
      }
      $query = "INSERT INTO `logininfotable` (`SR No`, `email`, `password`) VALUES (NULL, '$email', '$pass')";

      $queryResult = mysqli_query($conn, $query);

      if ($queryResult) {
        echo '<div class="alert alert-primary" role="alert">
  Your data is success fully submited in Database
</div>';
      } else {
        die('<div class="alert alert-danger" role="alert">
  Cannnot login with this profile!!
</div>');
      }
    }
    ?>
    <form action="/nikunj/formDatabase.php" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>