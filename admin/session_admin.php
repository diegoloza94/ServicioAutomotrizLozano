<?php
include('../db_connection.php');
session_start();

$user_check = $_SESSION['login_admin'];
$ses_sql = mysqli_query($conn, "select email_admin from admin where email_admin = '$user_check' ");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$login_session = $row['email_admin'];

if (!isset($_SESSION['login_admin'])) {
   header("Location:../index.php");
   die();
}
