<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "project";

    $conn = new mysqli($host, $username, $password, $database);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input to prevent SQL injection
    $shop_email = $conn->real_escape_string($_POST['shop_email']);
    $action = $_POST["action"];

    if ($action === "accept") {
        $sql = "UPDATE shop_insert SET status = 'accepted' WHERE shop_email = '$shop_email'";

        if ($conn->query($sql) === TRUE) {
            echo "Shop accepted successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "Invalid shop ID.";
}
?>
