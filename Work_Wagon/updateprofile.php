<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

$host = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = new mysqli($host, $username, $password, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    
    // Update user data in the database
    $update_query = "UPDATE normal_login SET name='$name', mobile_number='$mobile_number' WHERE email='" . $_SESSION['email'] . "'";
    
    if ($conn->query($update_query) === TRUE) {
        echo "Record updated successfully";
        header("Location: home.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$sql = "SELECT * FROM normal_login WHERE email = '" . $_SESSION['email'] . "'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Output data of the user
    while ($row = $result->fetch_assoc()) {
?>
<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <title>Update Profile</title>
</head>
<body>  
    <div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        <label>Email:</label>
        <?php echo $row['email']; ?><br>
        <label>Mobile number:</label>
        <input type="text" name="mobile_number" value="<?php echo $row['mobile_number']; ?>"><br>
        <input type="submit" value="Update">
    </form>
    </div>
</body>
</html>

<?php
    }
} else {
    echo "No results found for the given email.";
}
?>
