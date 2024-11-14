<?php

session_start();
if (!isset($_SESSION['shop_email'])) {
    header("Location: sidebar_loginshop.html"); // Redirect to the login page
    exit();
}
// Set the session timeout duration to 1 hour (3600 seconds)
$timeout = 3600;

// Check if the session has timed out
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // Session has timed out; destroy the session and redirect to the login page
    session_unset();
    session_destroy();
    header("Location: home.php");
    exit;
}

// Update the last activity timestamp on each page load
$_SESSION['last_activity'] = time();

// Rest of your code for the profile page
?>


<!DOCTYPE html>
<html>
<head> <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .profile-info {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0 auto;
            max-width: 400px;
        }

        .term-label {
            font-weight: bold;
        }

        .update-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #ffffff;
            background-color: #4caf50;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .update-link:hover {
            background-color: #45a049;
        }
    </style>
    <title>Profile Page</title>
</head>
<body><?php

$host = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = new mysqli($host, $username, $password, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 $sql = "SELECT * FROM shop_insert WHERE shop_email = '" . $_SESSION['shop_email'] . "' ";

        
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='profile-info'>";
        echo "<span class='term-label'>Shop Name:</span> " . $row["shop_name"] . "<br>";
        echo "<span class='term-label'>Job Name:</span> " . $row["shop_job_name"] . "<br>";
        echo "<span class='term-label'>Shopkeeper Name:</span> " . $row["shopkeeper_name"] . "<br>";
        echo "<span class='term-label'>Age required:</span> " . $row["shop_age_required"] . "<br>";
        echo "<span class='term-label'>Category:</span> " . $row["shop_category"] . "<br>"; 
        echo "<span class='term-label'>Mobile number:</span> " . $row["shop_mobile_number"] . "<br>";
        echo "<span class='term-label'>Email:</span> " . $row["shop_email"] . "<br>";
        echo "<span class='term-label'>City:</span> " . $row["shop_city"] . "<br>";
        echo "<span class='term-label'>Requirements:</span> " . $row["shop_requirements"] . "<br>";
        echo "<span class='term-label'>Address:</span> " . $row["shop_address"] . "<br>";
        echo "<span class='term-label'>Time In:</span> " . $row["time_in"] . " " . $row["time_in_ampm"] . "<br>";
        echo "<span class='term-label'>Time Out:</span> " . $row["time_out"] . " " . $row["time_out_ampm"] . "<br>
        <a href='update_side_profile.php' class='update-link'>Update Profile</a>";
        echo "</div>";

    
    }
} 
else {
    echo "No results found for the given worker email.";
}

?>
</body>
</html>
