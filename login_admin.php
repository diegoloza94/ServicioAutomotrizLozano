<!DOCTYPE html>
<html>

<head>
  <!-- Top Name -->
  <title>Servicio Automotriz Lozano</title>

  <meta charset="utf-8">
  <link rel="icon" href="./img/22.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/styles.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/javaScript.js"></script>

  <!--<style>
        body {
            background-color: #bcbebf;
        }
    </style>-->

  <style>
    body {
      background-image: url("img/home.jpg");
    }
  </style>
</head>

<body>
  <!-- Nav Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="img/logo.png" class="img-fluid" width="150px" height="150px" alt="alt" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <!-- Here you can put your email and password from admin from the table admin from db -->
  <div id="login">
    <form method="post">
      <div class="form-group">
        <h3 class="text-white">Staff Login</h3>
        </br>
        <label class="text-white" for="email_admin"> Staff Email:</label>
        <input name="email_admin" type="email" class="form-control" id="email_admin">
      </div>
      <div class="form-group">
        <label class="text-white" for="password_admin">Staff Password:</label>
        <input name="password_admin" type="password" class="form-control" id="password_admin">
      </div>
      <div class="checkbox">
        <label class="text-white"><input type="checkbox"> Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary">Log In</button>
    </form>
  </div>

</body>

</html>
<!-- PHP code -->
<!-- This php code is for log from the admin or the staff that they need to fix the car -->
<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email_admin = $_POST['email_admin'];
  $password_admin = $_POST['password_admin'];
  $sql = "SELECT * FROM admin WHERE email_admin='$email_admin' && password_admin='$password_admin'";
  $sqlName = "SELECT name_admin FROM admin WHERE email_admin='$email_admin' && password_admin='$password_admin'";

  $result = mysqli_query($conn, $sql);
  $resultName = mysqli_query($conn, $sqlName);
  $row = mysqli_fetch_assoc($result);

  $count = mysqli_num_rows($result);
  // In case if the data is match you will go directly to the main page from admin
  if ($count == 1) {
    $_SESSION['login_admin'] = $row['email_admin'];
    $_SESSION['login_name'] = $row['name_admin'];
    header('Location: success.html');
    header('Location: admin/index_admin.php');
  } else {
  // In case if is not match you will see this alert 
    echo '<script>alert("Your Login Name or Password is invalid!")</script>';
  }
}
?>