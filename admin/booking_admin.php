<!-- PHP Code -->
<?php
include('session_admin.php');
?>

<!DOCTYPE html>
<html>

<head>

  <head>
    <!-- Top Name -->
    <title>Servicio Automotriz Lozano</title>

    <meta charset="utf-8">
    <link rel="icon" href="../img/22.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/javaScript.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <!--<style>
        body {
            background-color: #bcbebf;
        }
    </style>-->

    <style>
      body {
        background-image: url("../img/home.jpg");
      }
    </style>
  </head>

<body>
  <!-- Nav Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="index_admin.php"><img src="../img/logo.png" class="img-fluid" width="150px" height="150px" alt="Servicio Automotriz Lozano" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index_admin.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="booking_admin.php">Print Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="managment.php">Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="invoice.php">Invoice</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_staff.php">Add Staff</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  <!-- Formulario -->
  <div id="sign-up" class="bootstrap-iso">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">

          <form method="get">
            <div class="form-group">
              <label class="control-label" for="date_booking">Choose a Date</label>

              <input class="form-control" id="date_booking" name="date" placeholder="YYYY-MM-DD" type="text" required />
            </div>
            <div class="form-group">

              <button class="btn btn-primary" id="submit" name="submit" type="submit">Search</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="sign-up">
    <?php
    if (isset($_GET['submit'])) {
      $date_chosen =  $_GET['date'];
      // Select everything from the tables booking and vehicle
      $sql = "SELECT *, vehicle.type_vehicle FROM booking 
              INNER JOIN vehicle ON booking.license_vehicle = vehicle.license_vehicle
              INNER JOIN staff ON booking.id_staff = staff.id_staff
              WHERE date_booking = ' $date_chosen'
              ORDER BY id_booking;";

      echo "<p class='text-white'>Click the button to print the current page.</p>

      <button onclick='myFunction()' class='btn btn-primary'>Print</button>
      
      <script>
      function myFunction() {
        window.print();
      }
      </script>";
      // table that the admin can see in the website
      if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          echo "  <table class='table table-hover'>
                          <thead class='text-white'>
                          <tr>
                          <th>Date</th>
                          <th>ID Booking</th>
                          <th>Make Vehicle</th>
                          <th>Type Vehicle</th>
                          <th>Engine Vehicle</th>
                          <th>License Vehicle</th>
                          <th>Service Type Booking</th>
                          <th>Staff</th>
                          <th>Comment</th>
                          </tr>
                          </thead>
                          <tbody>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr class='text-white'><td class='text-white'>" .
              $row["date_booking"] . "</td><td>" .
              $row["id_booking"] . "</td><td>" .
              $row["make_vehicle"] . "</td><td>" .
              $row["type_vehicle"] . "</td><td>" .
              $row["engine_type_vehicle"] . "</td><td>" .
              $row["license_vehicle"] . "</td><td>" .
              $row["service_type_booking"] . "</td><td>" .
              $row["name_staff"] . "</td><td>" .
              $row["comment_booking"] . "</td><td>" .
              "</td></tr>";
          }
          echo "</tbody>
                        </table> </br>";
        } else {
          echo "0 Result";
        }
      }
    }
    ?>
  </div>
  <!-- JS Code -->
  <script>
    $(document).ready(function() {
      var date_input = $('input[name="date"]');
      var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
      var options = {
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        daysOfWeekDisabled: [0],
      };
      date_input.datepicker(options);
    })
  </script>
</body>

</html>