<!DOCTYPE html>
<html lang="en">

<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "note-database";


$conn = mysqli_connect($host, $user, $password, $database);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //for edit the record
  if (isset($_POST['idEdit'])) {
    // echo "yes";
    $editTitleName = $_POST['edit-title-name'];
    $editDesc = $_POST['edit-desc'];
    $editId = $_POST['idEdit'];

    $editQuery = "UPDATE `note-table` SET `note-title` = '$editTitleName', `note-desc` = '$editDesc' WHERE `note-table`.`id` = $editId;";

    $sqlResult = mysqli_query($conn, $editQuery);

    $_SESSION['message'] = "Note edited successfully!";
    $_SESSION['alert-type'] = "success";

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }

  //for  delete the record
  if (isset($_POST['idDelete'])) {
    $deleteId = $_POST['idDelete'];
    $deleteQuery = "DELETE FROM `note-table` WHERE `note-table`.`id` = $deleteId";
    $sqlResult = mysqli_query($conn, $deleteQuery);

    header("Location: " . $_SERVER['PHP_SELF']);
    $_SESSION['message'] = "Note deleted successfully!";
    $_SESSION['alert-type'] = "warning";
    exit();
  }

  //insert the new record
  $insertBool = true;
  $noteTitle = $_POST['noteTitle'];
  $noteDesc = $_POST['noteDescription'];

  // echo "$noteTitle  $noteDesc";

  $inquery = "INSERT INTO `note-table` (`note-title`, `note-desc`) VALUES ('$noteTitle', '$noteDesc\r\n');";
  $sqlResultIn = mysqli_query($conn, $inquery);


  // Prevent form resubmission on page refresh
  header("Location: " . $_SERVER['PHP_SELF']);
  $_SESSION['message'] = "Note added successfully!";
  $_SESSION['alert-type'] = "primary";
  exit();

}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Note-App</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
</head>

<body>
  <!-- edit modal  -->

  <div class="modal fade " data-bs-theme="dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Note:</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/nikunj/phpProject/index.php" method="POST" class="row">
            <input type="hidden" name="idEdit" id="idEdit">
            <div class="mb-3 ">
              <label for="title-name" class="col-form-label">Title:</label>
              <input type="text" class="form-control " name="edit-title-name" id="title-name" required>
            </div>
            <div class="mb-3">
              <label for="desc-text" class="col-form-label">Description:</label>
              <textarea class="form-control" name="edit-desc" id="desc-text" required></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary edit-in-edit-btn">Edit</button>
              <button type="button" class="btn btn-secondary edit-in-close-btn" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- edit modal  -->


  <!-- delete modal -->

  <div class="modal fade" data-bs-theme="dark" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">do You want to delete?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- alert start   -->
          <div class="alert alert-warning " role="alert">
            <div class="alertInnerDiv">

            </div>
          </div>
          <!-- alert end     -->

          <form action="/nikunj/phpProject/index.php" method="POST">
            <input type="hidden" name="idDelete" id="idDelete">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- delete modal -->

  <!-- alert message  -->
  <?php
  if (isset($_SESSION['message'])) {
    $type = $_SESSION['alert-type']; // success, warning, primary etc.
    echo "<div class='alert alert-$type alert-dismissible fade show mt-2' role='alert'>
          <strong>{$_SESSION['message']}</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    unset($_SESSION['message']);
    unset($_SESSION['alert-type']);
  }
  ?>
  <!-- alert message  -->

  <main>

    <div class="form-container ">
      <form action="/nikunj/phpProject/index.php" method="POST">
        <div class="noteTitleContainer gap ">
          <label for="inputTitle" class="form-label">Note title</label>
          <input type="text" name="noteTitle" id="inputTitle" required>
        </div>
        <div class="noteDescriptionContainer gap">
          <label for="inputDescription">Note Description</label>
          <textarea name="noteDescription" id="inputDescription" required></textarea>
        </div>
        <div class="submitContainer">
          <button type="submit" class="submitBtn">Add Note</button>
        </div>

      </form>

    </div>

    <div class="result lg ">
      <hr>
      <table id="myTable" class="table display table-striped  table-hover">
        <thead>
          <tr>
            <th scope="col">Sr no.</th>
            <th scope="col">Note Title</th>
            <th scope="col">Note Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $outQuery = "SELECT * FROM `note-table`";
          $sqlResultOut = mysqli_query($conn, $outQuery);
          $i = 1;
          while ($row = mysqli_fetch_assoc($sqlResultOut)) {
            echo '<tr>
            <td>' . $i . '</td>
            <td>' . $row['note-title'] . '</td>
            <td>' . $row['note-desc'] . '</td>
            <td>     <button type="button" class="btn btn-primary btn-md edit mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" id="' . $row['id'] . '">Edit</button>
          <button type="button" class="btn btn-danger btn-md deleteBtn mb-q " data-bs-toggle="modal" data-bs-target="#deleteModal" id="' . $row['id'] . '">Delete </button></td>
          </tr>';

            $i++;
          }
          ?>

        </tbody>

      </table>
      <hr>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"> </script>
  <script>
    let table = new DataTable('#myTable');
  </script>


  <script src="script.js">

  </script>
</body>

</html>