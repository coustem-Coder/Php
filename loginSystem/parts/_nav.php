<?php
// session_start();
echo '<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/nikunj/loginSystem">PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/nikunj/loginSystem/welcome.php">Home</a>
        </li>';
if (!isset($_SESSION['username'])) {
  echo '<li class="nav-item">
          <a class="nav-link" href="/nikunj/loginSystem/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/nikunj/loginSystem/signup.php">SignUp</a>
        </li> </ul>';
} else {
  echo ' </ul> 
  <div class="userNav">
  <i class="fa-solid fa-user"></i>
  <h4 class="my-0">' . strtoupper($_SESSION['username']) . '</h4>
  </div>
     <button class="btn btn-outline-danger" type="submit">
        <a class="nav-link" href="/nikunj/loginSystem/logout.php">LogOut</a>
      </button>';
}

echo '</div>
  </div>
</nav>';
?>