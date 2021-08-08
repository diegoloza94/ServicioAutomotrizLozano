<!-- Is just to log out from the session and is useful for admin or customer -->

<?php
session_start();
if (session_destroy()) {
   header("Location: index.php");
}
?>