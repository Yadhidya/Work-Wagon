<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-HD/pPyHY4CUp6Zjq3F+9fh6QwOJpNLeRYCEbY6ekG24cO+gnyU1Z2mOzswlv9ASz" crossorigin="anonymous">
<link rel="stylesheet" href="requestcss.css">
</head>
    <body>
<?php

// Check the connection<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['shop_email'])) {
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM shoprequests WHERE TRIM(worker_available) ='yes' AND shop_email='" . $_SESSION['shop_email'] . "'";

    
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<form action='worker_replies.php' method='post'>";
            echo '<input type="hidden" name="worker_email" value="' . htmlspecialchars($row['worker_email']) . '"><br>';
            echo '<input type="hidden" name="shop_email" value="' . htmlspecialchars($_SESSION['shop_email']) . '">';
            echo "Worker Name: " . htmlspecialchars($row["worker_name"]) . "<br>";
            echo "Expected Salary: " . htmlspecialchars($row["worker_expected_salary"]) . "<br>";
            echo "Work Known: " . htmlspecialchars($row["worker_work_known"]) . "<br>";
            echo "Age: " . htmlspecialchars($row["worker_age"]) . "<br>";
            echo "City: " . htmlspecialchars($row["worker_city"]) . "<br>";
            echo "Availability: " . htmlspecialchars($row["worker_available"]) . "<br>";
            echo '<div>
                    <button type="submit" name="action" value="accept"><i class="fas fa-thumbs-up"></i>ACCEPT</button>
                  </div>
                  <div>
                    <button type="submit" name="action" value="reject">REJECT<i class="fas fa-thumbs-down"></i></button>
                  </div></form>';
        }
    } else {
        echo "No requests available now";
    }
    // Execute the query and handle errors



    $conn->close();
}
?>

</body>
</html>

