<!-- PHP code -->
<?php
include('session_customer.php');
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Top Name -->
  <title>Servicio Automotriz Lozano</title>
  <meta charset="utf-8">
  <link rel="icon" href="../img/22.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
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
      <a class="navbar-brand" href="index_customer.php"><img src="../img/logo.png" class="img-fluid" width="150px" height="150px" alt="Servicio Automotriz Lozano" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index_customer.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="booking.php">Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_car.php">Add Car</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="historial.php">Historial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Log Out</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"><?php echo "Welcome " . $_SESSION["login_name_customer"]; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div id="sign-up3">
    <form method="post" action="booking.php">
      <div class="form-group">
        <!-- Here the customer will choose the vehicle that the customer added -->
        <label class="text-white" for="sel1">Select Your Vehicle: </label>
        <!-- PHP code -->
        <?php
        $email_customer = $_SESSION["login_db"];
        $sql = "SELECT * FROM vehicle where email_customer = '$email_customer';";

        if ($result = mysqli_query($conn, $sql)) {
          if (mysqli_num_rows($result) > 0) {
            echo "<select class='form-control' id='license_vehicle' name='license_vehicle' required>";
            echo "<option></option>";
            while ($row = mysqli_fetch_array($result)) {

              echo "<option>" . $row['type_vehicle'] . "</option>";
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
        <br>
        <!-- here the customer can choose the type of service -->
        <label class="text-white" for="service_type_booking">Service Type Booking: </label>
        <select class="form-control" name="service_type_booking" id="service_type_booking" required>
          <option></option>
          <option value="Annual Service">Annual Service</option>
          <option value="Major Service">Major Service</option>
          <option value="Repair / Fault">Repair / Fault</option>
          <option value="Major Repair">Major Repair</option>
        </select>
        <br>
        <!-- the customer can leave what happened with their car -->
        <div class="form-group">
          <label class="text-white" for="comment_booking">Comment:</label>
          <textarea class="form-control" name="comment_booking" rows="3" placeholder="Tell us what happened with your car." id="comment_booking" required></textarea>
        </div>

        <br>

        <div class="bootstrap-iso">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">

                <form method="post">
                  <div class="form-group">
                    <!-- Date Bootstrap ISO-->
                    <label class="control-label" for="date_booking">Date</label>
                    <input class="form-control" id="date_booking" name="date" placeholder="YYYY-MM-DD" type="text" required />
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary " id="submit" name="submit" onclick="ChangeCarList()" type="submit">Booking</button>
                    <!-- PHP code -->
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      $service_type_booking = $_POST['service_type_booking'];
                      $comment_booking = $_POST['comment_booking'];
                      $date_booking = $_POST['date'];
                      $email_customer = $_SESSION["login_db"];
                      $license_vehicle = $_POST['license_vehicle'];
                      // Select using count to get the date from booking if you choose the date matching from Date Bootstrap ISO
                      $sql = "SELECT COUNT(date_booking) FROM booking 
                      where date_booking = '$date_booking';";

                      $result = mysqli_query($conn, $sql);
                      $count1 = mysqli_fetch_row($result);
                      $count = implode(" ", $count1);

                      if ($count < 16) {
                        // Select the license that the customer write when they added the car matchig with the email
                        $sql2 = "SELECT license_vehicle FROM vehicle 
                        where email_customer = '$email_customer' and type_vehicle = '$license_vehicle';";

                        $result1 = mysqli_query($conn, $sql2);
                        $license_vehicle1 = mysqli_fetch_row($result1);
                        $license_vehicle11 = implode(" ", $license_vehicle1);
                        // Insert to the table booking
                        $sql3 = "INSERT INTO booking ( service_type_booking, comment_booking, date_booking, email_customer,license_vehicle, status, id_staff) 
                        VALUES('$service_type_booking', '$comment_booking', '$date_booking','$email_customer', '$license_vehicle11', 'Booked', 1);";
                        $result = mysqli_query($conn, $sql3);

                        // Get everything from the table booking and save that info in a $row
                        $sql4 = "SELECT * from booking  
                        where date_booking = '$date_booking'
                        and license_vehicle = '$license_vehicle11';";
                        $result2 = mysqli_query($conn, $sql4);
                        $row = mysqli_fetch_assoc($result2);
                        $id_booking = $row['id_booking'];

                        // Insert the information in the table invoice
                        $sql33 = "INSERT INTO invoice (id_invoice, total_price_invoice, date_invoice, id_booking, license_vehicle, email_customer) 
                                  VALUES($id_booking, 0, '$date_booking',  $id_booking, '$license_vehicle11','$email_customer');";
                        $result = mysqli_query($conn, $sql33);

                        // In case the service type of booking is Major Repair will updtabel in the table invoice
                        if ($service_type_booking === "Major Repair") {

                          $sql34 = "UPDATE invoice 
                                    SET total_price_invoice= 160
                                    WHERE id_booking = $id_booking;";
                          $result2 = mysqli_query($conn, $sql34);

                          // Will insert in the table service with the amount
                          $sql5 = "INSERT INTO service (`name_service`, `price_service`, `id_invoice`)
                          VALUES ('Major Repair', 160 ,$id_booking);";

                          $result5 = mysqli_query($conn, $sql5);
                        } else 
                        // In case the service type of booking is Annual Service will updtabe in the table invoice
                        if ($service_type_booking === "Annual Service") {

                          $sql34 = "UPDATE invoice 
                          SET total_price_invoice= 235
                          WHERE id_booking = $id_booking;";
                          $result22 = mysqli_query($conn, $sql34);
                          // Insert in the table service that information
                          $sql5 = "INSERT INTO service (`name_service`, `price_service`, `id_invoice`)
                          VALUES ('Annual Service', 160 ,$id_booking);";

                          $result5 = mysqli_query($conn, $sql5);
                        } else
                        // In case the service type of booking is Major Service will updtabel in the table invoice
                        if ($service_type_booking === "Major Service") {

                          $sql344 = "UPDATE invoice 
                          SET total_price_invoice= 235
                          WHERE id_booking = $id_booking;";
                          $result26 = mysqli_query($conn, $sql344);

                          // Insert in the table service that information
                          $sql5 = "INSERT INTO service (`name_service`, `price_service`, `id_invoice`)
                          VALUES ('Major Service', 150, $id_booking);";

                          $result5 = mysqli_query($conn, $sql5);
                        } else

                        // In case the service type of booking is Repair / Fault will updtabel in the table invoice
                        if ($service_type_booking === "Repair / Fault") {

                          $sql34 = "UPDATE invoice 
                          SET total_price_invoice= 235
                          WHERE id_booking = $id_booking;";
                          $result2 = mysqli_query($conn, $sql34);

                          // Insert in the table service
                          $sql5 = "INSERT INTO service (`name_service`, `price_service`, `id_invoice`)
                         VALUES ('Repair / Fault', 240, $id_booking);";

                          $result5 = mysqli_query($conn, $sql5);
                        }
                      } else {
                        echo '<script>alert("There is no available time")</script>';
                      }
                    }
                    ?>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- JS code -->
        <script>
          $(document).ready(function() {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
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
      </div>
    </form>
  </div>
</body>

</html>