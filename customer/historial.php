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

    <title>Servicio Automotriz Lozano</title>
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

    <div id="sign-up">
        <!-- PHP Code -->
        <?php
        $email_customer = $_SESSION["login_db"];
        // Select all the information from the tables booking and vehicle
        $sql = "  SELECT *, vehicle.type_vehicle FROM booking 
              INNER JOIN vehicle ON vehicle.license_vehicle = booking.license_vehicle
              WHERE vehicle.email_customer = '$email_customer'
              ORDER BY date_booking;";

        // If everything is okey, will insert that information in a table
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo "  <table class='table table-hover'>
        <thead>
        <tr>
        <th class='text-white'>Date</th>
        <th class='text-white'>Id Booking</th>
        <th class='text-white'>Make Vehivle</th>
        <th class='text-white'>Type Vehicle</th>
        <th class='text-white'>Engine Vehicle</th>
        <th class='text-white'>Service Type Booking</th>
        <th class='text-white'>License Vehicle</th>
        <th class='text-white'>Status</th>
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
                        $row["service_type_booking"] . "</td><td>" .
                        $row["license_vehicle"] . "</td><td>" .
                        $row["status"] . "</td><td>" .
                        "</td></tr>";
                }
                echo "</tbody>
        </table>";
            } else {
                echo "0 Result";
            }
        }
        ?>
    </div>
</body>
</html>