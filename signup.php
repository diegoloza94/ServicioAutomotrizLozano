<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_customer = $_POST['name_customer'];
    $surname_customer = $_POST['surname_customer'];
    $password = $_POST['password'];
    $email_customer = $_POST['email_customer'];
    $phone_customer = $_POST['phone_customer'];
    // Insert to the table customer that you put with the keyboard
    $sql = "INSERT INTO customer (name_customer, surname_customer, password, email_customer, phone_customer) 
  			  VALUES('$name_customer', '$surname_customer', '$password', '$email_customer', '$phone_customer')";
    $result = mysqli_query($conn, $sql);
}

?>

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
        }-->

    <style>
        body {
            background-image: url("img/home.jpg");
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="img/logo.png" class="img-fluid" width="150px" height="150px" alt="Servicio Automotriz Lozano" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- Formulario -->
    <div id="sign-up2">
        <h2 class="text-white">Sign up</h2>
        <form method="post" action="signup.php" onsubmit="return checkForm(this);">
            <div class="form-group">
                <label class="text-white" for="name_customer">Name:</label>
                <input name="name_customer" type="name_customer" class="form-control" placeholder="Enter Name" id="name_customer" required>
            </div>

            <div class="form-group">
                <label class="text-white" for="surname_customer">Surname:</label>
                <input name="surname_customer" type="surname_customer" class="form-control" placeholder="Enter Surname" id="surname_customer" required>
            </div>

            <div class="form-group">
                <label class="text-white" for="password">Password:</label>
                <input name="password" type="password" minlength="8" class="form-control" placeholder="Enter Password" id="password" required>
            </div>

            <div class="form-group">
                <label class="text-white" for="email_customer">Email:</label>
                <input name="email_customer" type="email_customer" class="form-control" placeholder="Enter Email" id="email_customer" required>
            </div>

            <div class="form-group">
                <label class="text-white" for="phone_customer">Phone:</label>
                <input name="phone_customer" type="phone_customer" pattern="[0-9]{10}" class="form-control" placeholder="Enter Phone" id="phone_customer" required>
            </div>

            <p class="text-white"><input id="field_terms" onchange="this.setCustomValidity(validity.valueMissing ? 
            'Please indicate that you accept the Terms and Conditions' : '');" type="checkbox" required name="terms"> I accept the <a id="myBtn" href="#">
                    <u>Terms and Conditions</u></a></p>

            <button name="reg_user" type="submit" class="btn btn-primary">Submit</button>

            <div id="myModal" class="modal">

                <!-- Terms of Use -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Terms and Conditions agreements act as a legal
                        contract between you (the company) who has the
                        website or mobile app and the user who access your
                        website and mobile app.</p>
                    <p> Having a Terms and Conditions agreement is completely
                        optional. No laws require you to have one. Not even the
                        super-strict and wide-reaching General Data Protection Regulation (GDPR).</p>
                    <p> It's up to you to set the rules and guidelines that
                        the user must agree to. You can think of your Terms
                        and Conditions agreement as the legal agreement where
                        you maintain your rights to exclude users from your app
                        in the event that they abuse your app, where you maintain
                        your legal rights against potential app abusers, and so on.</p>
                    <p> Terms and Conditions are also known as Terms of Service or Terms of Use.</p>
                </div>

            </div>


            <script>
                document.getElementById("field_terms").setCustomValidity("Please indicate that you accept the Terms and Conditions");
            </script>
        </form>
        </br>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>