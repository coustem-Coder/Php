<?php

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="contact.php">Contact</a>
        </li>
      </ul>
      <form class="d-flex mx-2" role="search" action="search.php" >
        <input class="form-control me-2" type="text" placeholder="SearchQuestion" aria-label="Search" name="search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>';

if (isset($_SESSION['username'])) {

  echo '<div class="navUser me-2">
        <i class="fa-solid fa-user"></i>
        <p class="my-0">' . strtoupper($_SESSION['username']) . '</p>
      </div>
<button class="btn btn-outline-danger me-2"><a class="nav-link" href="logout.php" >LogOut</a> </button>';
} else {
  echo '  <button class="btn btn-outline-success me-2"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a> </button>
        <button class="btn btn-outline-success me-2"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</a> </button>
';
}


echo ' </div>
  </div>
</nav>';
include "parts/_loginModal.php";
include "parts/_signupModal.php";
?>