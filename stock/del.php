<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delete Notes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<?php
include '../dbconnect.php';

if (isset($_POST['submit']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Use parameterized query to prevent SQL injection
    $deleteQuery = "DELETE FROM notes WHERE id = ?";
    $params = array($id);

    // Attempt to execute the query
    $hasil = sqlsrv_query($koneksi, $deleteQuery, $params);

    if ($hasil) {
        echo "<div class='alert alert-success'>
            <strong>Success!</strong> Note has been deleted.
        </div>";
    } else {
        echo "<div class='alert alert-warning'>
            <strong>Error!</strong> Failed to delete note.
        </div>";
    }
} else {
    echo "<div class='alert alert-warning'>
        <strong>Error!</strong> Invalid request.
    </div>";
}

// Redirect back to the main page after displaying the message
echo "<meta http-equiv='refresh' content='1; url=index.php'/>";
?>

</body>
</html>
