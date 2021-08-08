<!DOCTYPE html>
<html lang="en">

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

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="img/logo.png" class="img-fluid" width="150px" height="150px" alt="Servicio Automotriz Lozano" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div id="login">
    <form method="post">
      <div class="form-group">
        <h3 class="text-white">Customer Login</h3>
        </br>
        <label class="text-white" for="email_customer">Customer Email:</label>
        <input name="email_customer" type="email" class="form-control" id="email_customer">
      </div>
      <div class="form-group">
        <label class="text-white" for="password">Customer Password:</label>
        <input name="password" type="password" class="form-control" id="password">
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

<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email_customer = $_POST['email_customer'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM customer WHERE email_customer='$email_customer' && Password='$password'";
  $sqlName = "SELECT name FROM customer WHERE email_customer='$email_customer' && Password='$password'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $count = mysqli_num_rows($result);
  // In case if the data is match you will go directly to the main page from customer
  if ($count == 1) {
    $_SESSION['login_db'] = $row['email_customer'];
    $_SESSION['login_name_customer'] = $row['name_customer'];
    header('Location: success.html');
    header('Location: customer/index_customer.php');
  } else {
  // In case if is not match you will see this alert
    echo '<script>alert("Your Login Name or Password is invalid!")</script>';
  }
}
?>