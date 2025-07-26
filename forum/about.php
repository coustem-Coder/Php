<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>iDiscuss-About Us</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero-section {
      background-color: #f8f9fa;
      padding: 60px 0;
      text-align: center;
    }

    .about-image {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
    }
  </style>
</head>

<body>

  <!-- Header / Navbar (optional) -->
  <?php
  include "parts/_header.php";
  ?>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <h1 class="display-5 fw-bold">About Us</h1>
      <p class="lead">Learn more about our mission, our values, and what we offer.</p>
    </div>
  </section>

  <!-- About Content Section -->
  <section class="container py-5">
    <div class="row align-items-center">
      <div class="col-md-6">
     <img src="Logo of iDiscuss on White Background.png" alt="iDiscuss Logo" width="230px">
      </div>
      <div class="col-md-6">
        <h2>Who We Are</h2>
        <p>
          We are a passionate team of developers, designers, and creators dedicated to building intuitive and impactful
          digital experiences.
        </p>
        <h4>Our Mission</h4>
        <p>
          Our mission is to empower individuals and businesses with quality web solutions that are modern, responsive,
          and user-friendly.
        </p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    &copy; <?php echo date("Y"); ?> iDiscuss. All rights reserved.
  </footer>

</body>

</html>