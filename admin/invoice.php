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
  <div id="division">
    <div id="a111">
      <form method="get">
        <label class="text-white" for="id_invoice">ID Invoice: </label>
        <input name="id_invoice" type="text" class="form-control" placeholder="Enter ID Invoice" id="id_invoice" required>

        <div class="form-group">
          <button name="search" type="submit" class="btn btn-primary">Search</button>
        </div>
      </form>
    </div>
    <!-- You can select all the services -->
    <div id="a111">
      <form method="post">
        <label class="text-white" for="id_service">Services: </label>
        <select class="form-control" id="id_service" name="id_service">
            <option>Seat cover</option>
            <option>Seat track</option>
            <option>Anti-lock braking system</option>
            <option>ABS steel pin</option>
            <option>Adjusting mechanism</option>
            <option>Anchor</option>
            <option>Bleed nipple</option>
            <option>Brake backing plate</option>
            <option>Brake backing pad</option>
            <option>Brake cooling duct</option>
            <option>Brake disc</option>
            <option>Brake drum</option>
            <option>Brake line</option>
            <option>Brake pad</option>
            <option>Brake pedal</option>
            <option>Brake piston</option>
            <option>Brake pump</option>
            <option>Brake roll</option>
            <option>Brake rotor</option>
            <option>Brake servo</option>
            <option>Brake shoe</option>
            <option>Brake lining</option>
            <option>Shoe web</option>
            <option>Brake warning light</option>
            <option>Calibrated friction brake</option>
            <option>Caliper</option>
            <option>Combination valve</option>
            <option>Dual circuit brake system</option>
            <option>Hold-down springs</option>
            <option>Hose</option>
            <option>Brake booster hose</option>
            <option>Air brake nylon hose</option>
            <option>Brake duct hose</option>
            <option>Hydraulic booster unit</option>
            <option>Load-sensing valve</option>
            <option>Master Cylinder</option>
            <option>Metering valve</option>
            <option>Other braking system parts</option>
            <option>Park brake lever/handle</option>
            <option>Pressure differential valve</option>
        </select>

        <!-- Button -->
        <div class="form-group">
          <button name="add-service" type="submit" class="btn btn-primary">Add Service</button>
        </div>
      </form>
    </div>


    <div id="a111">
      <!-- Print -->
      <label class="text-white" for="id">Print Invoice: </label>
      <div class="form-group">
        <button onclick='myFunction()' class='btn btn-primary'>Print</button>
      </div>
      <script>
        function myFunction() {
          window.print();
        }
      </script>
    </div>
  </div>
  <!-- PHP Code -->
  <?php

  if (isset($_GET['search'])) {
    $id =  $_GET['id_invoice'];
    $_SESSION['id_invoice'] = $id;
    $todays_date = date("Y-m-d");
    // Select everything from the table invoice, vehicle, customer and booking
    $sql = "SELECT * FROM invoice 
            INNER JOIN vehicle ON vehicle.license_vehicle = invoice.license_vehicle
            INNER JOIN customer ON customer.email_customer = invoice.email_customer
            INNER JOIN booking ON booking.id_booking = invoice.id_invoice
            WHERE id_invoice = $id;";


    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        // Will show a table 
        echo "<div id='divisionInvoice'>
                   <div id='a111'> 
                       <img src='../img/logo.png' style='width: 150px;' alt='Servicio Automotriz Lozano'>
                   </div>

                   <div id='a111'> 
                       <label>Id Invoice : </label>
                       <label>" . $id . "</label>
                       </br>
                       <label>Date: </label>
                       <label>" . $todays_date . "</label>                  
                   </div>
              </div> ";

        echo " <div id='divisionInvoice'>
           <div id='a112'> 
            <label>Customer </label>
            <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;'>
                          <thead>
                          <tr>
                          <th>Name Customer</th>
                          <th>Surname Customer</th>
                          <th>Phone Customer</th>
                          <th>Email Customer</th>
                          </tr>
                          </thead>
                          <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["name_customer"] . "</td><td>" .
            $row["surname_customer"] . "</td><td>" .
            $row["phone_customer"] . "</td><td>" .
            $row["email_customer"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                        </table></div>";
      } else {
        echo "0 Result";
      }
    }
    // Will show a table
    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo "  <div id='a112'> 
            <label>Vehicle </label>
            <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;'>
                          <thead>
                          <tr>
                          <th>Make Vehicle</th>
                          <th>Type Vehicle</th>
                          <th>Engine Vehicle</th>
                          <th>License Vehicle</th>
                          </tr>
                          </thead>
                          <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["make_vehicle"] . "</td><td>" .
            $row["type_vehicle"] . "</td><td>" .
            $row["engine_type_vehicle"] . "</td><td>" .
            $row["license_vehicle"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                        </table> </div></div>";
      } else {
        echo "0 Result";
      }
    }
    // Will show a table
    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo " <div id='divisionInvoice' >
          <div id='a112'>
          <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;' >
                            <thead>
                            <tr>
                            <th>Comment</th>
                            </tr>
                            </thead>
                            <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["comment_booking"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                          </table></div></div>";
      } else {
        echo "0 Result";
      }
    }
    // Select everything from the table service
    $id_invoice =  $_GET['id_invoice'];
    $sql66 = "SELECT * FROM service WHERE id_invoice = $id_invoice;";
    // Will show a table
    if ($result = mysqli_query($conn, $sql66)) {
      if (mysqli_num_rows($result) > 0) {
        echo " <div id='divisionInvoice'>
           <div id='a112'>
      <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;' >
                        <thead>
                        <tr>
                        <th>Service</th>
                        <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["name_service"] . "</td><td>" .
            $row["price_service"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                      </table></div></div>";
      } else {
        echo "0 Result";
      }

      $sql9 = "SELECT SUM(price_service)
               FROM service
               WHERE id_invoice =  $id_invoice;";

      $sum_total1 = mysqli_query($conn, $sql9);
      $sum_total2 = mysqli_fetch_row($sum_total1); //array
      $sum_total3 = implode(" ", $sum_total2);

      $todays_date = date("Y-m-d");
      $sql33 = "UPDATE invoice 
                SET total_price_invoice= $sum_total3
                WHERE id_invoice = $id_invoice;";

      $result = mysqli_query($conn, $sql33);


      $todays_date = date("Y-m-d");
      $sql333 = "UPDATE invoice 
                SET date_invoice= $todays_date
                WHERE id_invoice = $id_invoice;";

      $result = mysqli_query($conn, $sql333);


      $id_invoice =  $_GET['id_invoice'];
      $sql662 = "SELECT * FROM invoice WHERE id_invoice = $id_invoice;";

      if ($result62 = mysqli_query($conn, $sql662)) {
        if (mysqli_num_rows($result62) > 0) {
          while ($row = $result62->fetch_assoc()) {
            echo " <div id='divisionInvoice'>
               <div id='a112'>
               <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;' >
                 <thead>
                 <tr>
                 <th>Total Amount €:</th>
                 <th>" .
              $row["total_price_invoice"] . "</th>
                 </tr>
                 </thead>
                 <tbody>";
          }
          echo "</tbody>
                 </table></div></div>";
        } else {
          echo "0 Result";
        }
      }
    }
  }
  ?>
  <!-- PHP Code -->
  <?php
  if (isset($_POST['add-service'])) {
    $id_invoice = $_SESSION['id_invoice'];
    $name_service =  $_POST['id_service'];
    //echo '<script type="text/javascript">alert("'.$name_service.'");</script>';//working
    $sql = "SELECT * FROM service_cost where name_service = '$name_service';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $price_service = $row['cost_service'];
    
    

    $sql5 = "INSERT INTO service (`name_service`, `price_service`, `id_invoice`)
            VALUES ('$name_service', $price_service, $id_invoice);";
    //echo '<script type="text/javascript">alert("'.$sql5.'");</script>';//working

    $result5 = mysqli_query($conn, $sql5);

    echo "<meta http-equiv='refresh' content='0'>";
  }
  ?>
</body>

</html>