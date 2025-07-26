<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>iDiscuss - Contact Us</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php
  include "parts/_header.php";
  ?>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Contact Us</h2>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
      <div class="alert alert-success">Thank you! Your message has been sent.</div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
      <div class="alert alert-danger">Something went wrong. Please try again.</div>
    <?php endif; ?>

    <form>
      <div class="mb-3">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" required>
      </div>

      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
  </div>

</body>

</html>