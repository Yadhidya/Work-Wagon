<?php
session_start();
unset($_SESSION['shop_email']);
if (isset($_SESSION['shop_email'])) {
    session_destroy();
}
unset($_SESSION['worker_email']);
if (isset($_SESSION['worker_email'])) {
    session_destroy();
}
// Redirect the user back to the home page
header("Location: home.php");
exit();
?>
