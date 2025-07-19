<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>getPost</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
  <style>
    body,
    html {
      height: 100vh;
      width: 100%;
    }

    .container {
      height: 60%;
      width: 50%;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $pass = $_POST['password'];
      echo '<div class="alert alert-primary" role="alert">
  Success fully login in ' . $email . '
</div>';
      // echo "<br> $email $pass";
    }
    ?>
    <form action="/nikunj/getPost.php" method="POST">
      <h1>Please Enter you email and password</h1>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name=" password" id="exampleInputPassword1">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>


  </div>


  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>