<!-- PHP code -->
<?php
include('session_admin.php');
?>
<!-- PHP code -->
<?php

if (isset($_POST['reg_user'])) {
    $name_staff = $_POST['name_staff'];
    $surname_staff = $_POST['surname_staff'];
    $phone_staff = $_POST['phone_staff'];

    // Insert in the table staff the information that you write from the keyboard
    $sql = "INSERT INTO staff (name_staff, surname_staff, phone_staff) 
  	    VALUES('$name_staff', '$surname_staff', '$phone_staff')";
    $result = mysqli_query($conn, $sql);
}

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
    <!-- Formulario where the admin can write about the new staff -->
    <div id="sign-up3">
        <div id="a111">
            <form method="post">
                <div class="form-group">
                    <label class="text-white" for="name_staff">Staff Name:</label>
                    <input name="name_staff" type="name_staff" class="form-control" placeholder="Enter staff name" id="name_staff" required>
                </div>
                <br>
                <div class="form-group">
                    <label class="text-white" for="surname_staff">Staff Surname:</label>
                    <input name="surname_staff" type="surname_staff" class="form-control" placeholder="Enter staff surname" id="surname_staff" required>
                </div>
                <br>
                <div class="form-group">
                    <label class="text-white" for="phone_staff">Staff Phone:</label>
                    <input name="phone_staff" type="phone_staff" class="form-control" placeholder="Enter staff phone" id="phone_staff" required>
                </div>
                <button name="reg_user" type="submit" class="btn btn-primary">Add Staff</button>

            </form>
        </div>

        <br>

        <div id="a111">
            <!-- PHP Code -->
            <?php
            // Select everything from the table staff
            $sql = "SELECT * FROM staff
                    HAVING id_staff > 1;";
            // when you select everything, then will insert and show in the table
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    echo " 
                    <table class='table table-hover'>
                            <thead class='text-white'>
                            <tr>
                            <th>Id Staff</th>
                            <th>Staff Name</th>
                            <th>Staff Surname</th>
                            <th>Staff Phone</th>
                            </tr>
                            </thead>
                            <tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='text-white'><td class='text-white'>" .
                            $row["id_staff"] . "</td><td>" .
                            $row["name_staff"] . "</td><td>" .
                            $row["surname_staff"] . "</td><td>" .
                            $row["phone_staff"] . "</td><td>" .
                            "</td></tr>";
                    }
                    echo "</tbody>
                                </table> </br> </br></br>";
                } else {
                    echo "0 Result";
                }
            }
            ?>
        </div>
    </div>

    <div id="sign-up3">
        <!-- Formulario to delete a staff from their ID -->
        <div id="a111">
            <form method="post">
                <div class="form-group">
                    </br></br><br>
                    <label class="text-white" for="delete"> Delete Staff by ID:</label>
                    <input name='delete' type="text" class="form-control" placeholder="Enter id staff" id="delete" required>
                </div>
                <button name="delete_button" type="submit" class="btn btn-danger">Delete Staff</button>
            </form>
        </div>
        <div id="a111">
        </div>
    </div>

    <!-- PHP Code -->
    <?php
    if (isset($_POST['delete_button'])) {
        $id = $_POST['delete'];
        $sql = "DELETE FROM staff where id_staff = $id;";

        if ($id == 1) {
        } else {
            $result = mysqli_query($conn, $sql);
        }
    }
    ?>
</body>
</html>