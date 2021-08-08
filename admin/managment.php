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
  <!-- Formulario -->
  <div id="sign-up3">
    <form method="get">
      <div class="form-group">
        <label class="text-white" for="id_booking">ID Booking:</label>
        <input name="id_booking" type="text" class="form-control" placeholder="Enter Id Booking" id="id_booking" required>
        <div class="form-group">
          <button name="submit" type="submit" class="btn btn-primary">Search</button>
        </div>
      </div>
    </form>
    <br>
    <!-- Formulario -->
    <form method="post">
      <div class="form-group">
        <label class="text-white" for="engine_type_vehicle">Status:</label>
        <select class="form-control" name="status" id="status">
          <option>In Service</option>
          <option>Fixed / Completed</option>
          <option>Collected</option>
          <option>Unrepairable / Scrapped</option>
        </select>
        <br>
        <br>
        <div class="form-group">
          <label class="text-white" for="license_vehicle">Staff Name:</label>
          <!-- PHP Code -->
          <?php
          $sql = "SELECT * FROM staff;";

          if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
              echo "<select class='form-control' id_staff='staff' name='staff' required>";
              echo "<option></option>";
              while ($row = mysqli_fetch_array($result)) {

                echo "<option>" . $row['name_staff'] . "</option>";
              }
              echo "</select>";
              mysqli_free_result($result);
            } else {
              echo "No records matching your query were found.";
            }
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
          ?>

        </div>
        <button name="update" type="submit" class="btn btn-primary">Update</button>
      </div>

    </form>
  </div>

  <!-- PHP Code -->
  <?php
  if (isset($_GET['submit'])) {
    $id =  $_GET['id_booking'];
    $_SESSION['id_booking'] = $id;
    // Select the information from the tables booking, vehicle, staff
    $sql = "SELECT *, vehicle.type_vehicle FROM booking 
               INNER JOIN vehicle ON booking.license_vehicle = vehicle.license_vehicle
               INNER JOIN staff ON staff.id_staff = booking.id_staff
               WHERE id_booking = $id;";

    if ($result = mysqli_query($conn, $sql)) {
      // Will show a table
      if (mysqli_num_rows($result) > 0) {
        echo "  <div id='sign-up'>
          <table style ='width: -webkit-fill-available;'>
                    <thead class='text-white'>
                    <tr>
                    <th>Date</th>
                    <th>ID Booking</th>
                    <th>Type Vehicle</th>
                    <th>Engine Vehicle</th>
                    <th>Make Vehicle</th>
                    <th>Service Type Booking</th>
                    <th>License Vehicle</th>
                    <th>Status</th>
                    <th>Staff</th>
                    </tr>
                    </thead>
                    <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr class='text-white'><td class='text-white'>" .
            $row["date_booking"] . "</td><td>" .
            $row["id_booking"] . "</td><td>" .
            $row["type_vehicle"] . "</td><td>" .
            $row["engine_type_vehicle"] . "</td><td>" .
            $row["make_vehicle"] . "</td><td>" .
            $row["service_type_booking"] . "</td><td>" .
            $row["license_vehicle"] . "</td><td>" .
            $row["status"] . "</td><td>" .
            $row["name_staff"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                  </table></div></br>";
      } else {
        echo "0 Result";
      }
    }

    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo " <div id='sign-up'> <table style ='width: -webkit-fill-available;' >
                    <thead class='text-white'>
                    <tr>
                    <th >Comment</th>
                    </tr>
                    </thead>
                    <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr class='text-white'><td class='text-white'>" .
            $row["comment_booking"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                  </table></div></br>";
      } else {
        echo "0 Result";
      }
    }
  }
  ?>
  <!-- PHP code -->
  <?php
  if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $name_staff = $_POST['staff'];
    $id_booking = $_SESSION['id_booking'];
    $sql1 = "SELECT id_staff FROM staff WHERE name_staff = '$name_staff';";

    $result1 = mysqli_query($conn, $sql1);
    $id2 = mysqli_fetch_row($result1);
    $id_staff = implode(" ", $id2);

    $sql = "UPDATE booking
            SET status='$status', id_staff= $id_staff
            WHERE id_booking = $id_booking;";
    $result = mysqli_query($conn, $sql);

    $sql33 = "UPDATE invoice 
              SET id_staff= $id_staff
              WHERE id_booking = $id_booking;";
    $result = mysqli_query($conn, $sql33);
    // Refresh everything
    echo "<meta http-equiv='refresh' content='0'>";
  }
  ?>
</body>
</html>