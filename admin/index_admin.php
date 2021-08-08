<!-- PHP Code -->
<?php
include('session_admin.php');
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Top Name -->
  <title>Servicio Automotriz Lozano</title>

  <meta charset="utf-8">
  <link rel="icon" href="../img/22.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/styles.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/javaScript.js"></script>

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
  <!-- here the admin can see all the booking that they have during the day -->
  <div id="sign-up">
    <label class="text-white" for="booking_day">All the Booking of the day</label>
    <?php
    $todays_date = date("Y-m-d");
    $sql = "SELECT *, vehicle.type_vehicle FROM booking 
            INNER JOIN vehicle ON booking.license_vehicle = vehicle.license_vehicle
            INNER JOIN staff ON staff.id_staff = booking.id_staff
            WHERE date_booking =  '$todays_date';";

    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo "  <table class='table table-hover'>
                          <thead class='text-white'>
                          <tr>
                          <th>Date</th>
                          <th>Id Booking</th>
                          <th>Make Vehicle</th>
                          <th>Type Vehicle</th>
                          <th>Engine Vehicle</th>
                          <th>License Vehicle</th>
                          <th>Service Type Booking</th>
                          <th>Status</th>
                          <th>Staff</th>
                          </tr>
                          </thead>
                          <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr class='text-white' ><td class='text-white'>" .
            $row["date_booking"] . "</td><td>" .
            $row["id_booking"] . "</td><td>" .
            $row["make_vehicle"] . "</td><td>" .
            $row["type_vehicle"] . "</td><td>" .
            $row["engine_type_vehicle"] . "</td><td>" .
            $row["license_vehicle"] . "</td><td>" .
            $row["service_type_booking"] . "</td><td>" .
            $row["status"] . "</td><td>" .
            $row["name_staff"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
        </table> </br>";
      } else {
        echo "0 Result";
      }
    }
    ?>
    </br>
    <!-- Here the Admin can see all the bookings that the customer request for the week -->
    <label class="text-white" for="bookings_week">All the Bookings of the week</label>
    <?php
    $todays_date = date("Y-m-d");
    $six_days_date = date('Y-m-d', strtotime($todays_date . ' + 6 days'));
    // select all the information from the tables booking and vehicle
    $sql = "SELECT *, vehicle.type_vehicle FROM booking 
            INNER JOIN vehicle ON booking.license_vehicle = vehicle.license_vehicle
            INNER JOIN staff ON staff.id_staff = booking.id_staff
            WHERE date_booking BETWEEN '$todays_date' and '$six_days_date' ORDER BY date_booking;";
    // Will show a table with the information 
    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo "  <table class='table table-hover'>
        <thead class='text-white'>
        <tr>
        <th>Date</th>
        <th>Id Booking</th>
        <th>Make Vehicle</th>
        <th>Type Vehicle</th>
        <th>Engine Vehicle</th>
        <th>License Vehicle</th>
        <th>Service Type Booking</th>
        <th>Status</th>
        <th>Staff</th>
        </tr>
        </thead>
        <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr class='text-white' ><td class='text-white'>" .
            $row["date_booking"] . "</td><td>" .
            $row["id_booking"] . "</td><td>" .
            $row["make_vehicle"] . "</td><td>" .
            $row["type_vehicle"] . "</td><td>" .
            $row["engine_type_vehicle"] . "</td><td>" .
            $row["license_vehicle"] . "</td><td>" .
            $row["service_type_booking"] . "</td><td>" .
            $row["status"] . "</td><td>" .
            $row["name_staff"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
        </table> ";
      } else {
        echo "0 Result";
      }
    }
    ?>
  </div>
</body>
</html>