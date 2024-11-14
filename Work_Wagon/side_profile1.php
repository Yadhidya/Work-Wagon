<?php

session_start();
if (!isset($_SESSION['worker_email'])) {
    header("Location: sidebar_loginworker.php"); // Redirect to the login page
    exit();
}
// Set the session timeout duration to 1 hour (3600 seconds)
$timeout = 3600;

// Check if the session has timed out
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // Session has timed out; destroy the session and redirect to the login page
    session_unset();
    session_destroy();
    header("Location: sidebar_loginworker.php");
    exit;
}

// Update the last activity timestamp on each page load
$_SESSION['last_activity'] = time();

// Rest of your code for the profile page
?>


<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .profile-info {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
            width: 300px;
        }

        .profile-info h2 {
            margin-top: 0;
            font-size: 24px;
        }
        .profile-info p {
            margin: 10px 0;
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
 $sql = "SELECT * FROM worker_insert WHERE worker_email = '" . $_SESSION['worker_email'] . "' ";

        
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='profile-info'>";
        
        echo "Worker Name: " . htmlspecialchars($row["worker_name"]) . "<br>";
        echo "Expected Salary: " . htmlspecialchars($row["worker_salary"]) . "<br>";
        echo "Work Known: " . htmlspecialchars($row["worker_work_known"]) . "<br>";
        echo "Age: " . htmlspecialchars($row["worker_age"]) . "<br>";
        echo "City: " . htmlspecialchars($row["worker_city"]) . "<br>";
        echo "Email: " . htmlspecialchars($row["worker_email"]) . "<br>";
        echo "Mobile number: " . htmlspecialchars($row["worker_mobile_number"]) . "<br>";
        echo "Availability: " . htmlspecialchars($row["worker_available"]) . "<br>
        <a href='update_side_profile1.php' class='update-link'>Update Profile</a>";
        echo "</div>";

    
    }
} 
else {
    echo "No results found for the given worker email.";
}

?>
</body>
</html>
