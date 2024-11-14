<?php
session_start();
unset($_SESSION['email']);
if (isset($_SESSION['email'])) {
    session_destroy();
}

// Redirect the user back to the home page
header("Location: index.php");
exit();
?>
