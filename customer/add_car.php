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
        <form method="post" action="add_car.php">
            <!-- You can select which make of vehicle do you have -->
            <div class="form-group">
                <label class="text-white" for="make_vehicle">Make:</label>
                <select class="form-control" id="make_vehicle" name="make_vehicle" onchange="ChangeCarList()">
                    <option value="">-- Vehicle --</option>
                    <option value="Audi">Audi</option>
                    <option value="BMW">BMW</option>
                    <option value="Chevrolet">Chevrolet</option>
                    <option value="Volkswagen">Volkswagen</option>
                    <option value="Nissan">Nissan</option>
                    <option value="Mini">Mini</option>
                    <option value="Toyota">Toyota</option>
                    <option value="Honda">Honda</option>
                    <option value="Ford">Ford</option>
                    <option value="KIA">KIA</option>
                </select>
                <br>
                <!-- Which kind of type of vehicle do you have -->
                <label class="text-white" for="type_vehicle">Type Vehicle:</label>
                <select class="form-control" name="type_vehicle" id="type_vehicle" required>
                </select>
                <br>
                <!-- Which kind of engine the car has -->
                <label class="text-white" for="engine_type_vehicle">Engine Type Vehicle:</label>
                <select class="form-control" name="engine_type_vehicle" id="engine_type_vehicle">
                    <option>Diesel</option>
                    <option>Petrol</option>
                    <option>Hybrid</option>
                    <option>Electric</option>
                </select>
                <br>
                <!-- write the license from your vehicle -->
                <div class="form-group">
                    <label class="text-white" for="license_vehicle">License Vehicle:</label>
                    <input name="license_vehicle" type="license_vehicle" class="form-control" placeholder="Enter License Vehicle" id="license_vehicle" required>
                </div>
                <br>

                <button name="reg_vehicle" type="submit" class="btn btn-primary">Register</button>
            </div>

        </form>
    </div>

    <script>
        // This script you can use to see the models from your vehicle
        var carsAndModels = {};
        carsAndModels['Audi'] = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8'];
        carsAndModels['BMW'] = ['M6', 'X5', 'Z3'];
        carsAndModels['Chevrolet'] = ['Aveo', 'Blazer', 'C10', 'Captiva', 'Camaro', 'Silverado'];
        carsAndModels['Ford'] = ['Fiesta', 'Focus', 'Ka', 'Figo', 'Escort'];
        carsAndModels['KIA'] = ['Ceed', 'Forte - Picanto', 'Ray', 'Rio', 'Soul'];
        carsAndModels['Nissan'] = ['Leaf', 'Micra', 'Note', 'Altima', 'Almera', 'Maxima', 'Sentra'];
        carsAndModels['Volkswagen'] = ['Golf', 'Polo', 'Scirocco', 'Touareg'];
        carsAndModels['Honda'] = ['City', 'Civic', 'Accord'];




        function ChangeCarList() {
            var carList = document.getElementById("make_vehicle");
            var modelList = document.getElementById("type_vehicle");
            var selCar = carList.options[carList.selectedIndex].value;
            while (modelList.options.length) {
                modelList.remove(0);
            }
            var cars = carsAndModels[selCar];
            if (cars) {
                var i;
                for (i = 0; i < cars.length; i++) {
                    var car = new Option(cars[i], carsAndModels[i]);
                    modelList.options.add(car);
                }
            }
        }
    </script>
    <!-- PHP code -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $license_vehicle = $_POST['license_vehicle'];
        $type_vehicle = $_POST['type_vehicle'];
        $engine_type_vehicle = $_POST['engine_type_vehicle'];
        $make_vehicle = $_POST['make_vehicle'];
        $email_customer = $_SESSION["login_db"];
        // Insert to the table vehicle
        $sql = "INSERT INTO vehicle (license_vehicle, type_vehicle, engine_type_vehicle, make_vehicle, email_customer) 
                        VALUES('$license_vehicle', '$type_vehicle', '$engine_type_vehicle', '$make_vehicle', '$email_customer');";
        $result = mysqli_query($conn, $sql);
    }
    ?>

    <div id="sign-up">
        <!-- PHP code -->
        <?php
        $email_customer = $_SESSION["login_db"];
        // Select everything from the table vehicle when is match the email from login
        $sql = "SELECT * FROM vehicle WHERE email_customer = '$email_customer'
            ORDER BY make_vehicle;";

        // Table to see all the information that you want
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo " <div  id='sign-up3'> <table class='table table-hover'>
        <thead>
        <tr>
        <th class='text-white' >Make Vehicle</th>
        <th class='text-white'>Type Vehicle</th>
        <th class='text-white'>Engine Vehicle</th>
        <th class='text-white'>License Vehicle</th>
        </tr>
        </thead>
        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='text-white'><td class='text-white'>" .
                        $row["make_vehicle"] . "</td><td>" .
                        $row["type_vehicle"] . "</td><td>" .
                        $row["engine_type_vehicle"] . "</td><td>" .
                        $row["license_vehicle"] . "</td><td>" .
                        "</td></tr>";
                }
                echo "</tbody>
        </table></div>";
            } else {
                echo "0 Result";
            }
        }
        ?>
    </div>
</body>
</html>