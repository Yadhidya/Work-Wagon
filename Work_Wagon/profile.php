<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php"); 
    exit();
}
$timeout = 3600;

// Check if the session has timed out
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    
    exit;
}

$_SESSION['last_activity'] = time();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .profile-info {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .profile-info span {
            font-weight: bold;
        }
        .update-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .update-link:hover {
            background-color: #45a049;
        }
        </style>
</head>
<body>  
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = new mysqli($host, $username, $password, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 $sql = "SELECT * FROM normal_login WHERE email = '" . $_SESSION['email'] . "' ";

        
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {


        echo "
        <div class='profile-container'>
        <div  class='profile-info'> <span>Name:</span> " . $row["name"] . "<br>";
        echo "<span>Email:</span>Email: " . $row["email"] . "<br>";
        echo " <span>Mobile number:</span>" . $row["mobile_number"] . "<br>";
        echo"
        
    </div><a href='updateprofile.php' class='update-link'>Update Profile</a>
 
    </div>
    ";
    }
} 
else {
    echo "No results found for the given worker email.";
}

?>
</body>
</html>
