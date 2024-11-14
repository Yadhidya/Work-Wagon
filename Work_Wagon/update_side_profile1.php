<?php
session_start();
if (!isset($_SESSION['worker_email'])) {
    header("Location: side_loginworker.php"); // Redirect to the login page if not logged in
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
    $worker_name = mysqli_real_escape_string($conn, $_POST['worker_name']);
    $worker_mobile_number = mysqli_real_escape_string($conn, $_POST['worker_mobile_number']);
    $worker_age = mysqli_real_escape_string($conn, $_POST['worker_age']);
    $worker_salary = mysqli_real_escape_string($conn, $_POST['worker_salary']);
    $worker_available = mysqli_real_escape_string($conn, $_POST['worker_available']);

    // Update worker data in the database
    $update_query = "UPDATE worker_insert SET 
                        worker_name='$worker_name',
                        worker_mobile_number='$worker_mobile_number',
                        worker_age='$worker_age',
                        worker_salary='$worker_salary',
                        worker_available='$worker_available'
                        WHERE worker_email='" . $_SESSION['worker_email'] . "'";

    if ($conn->query($update_query) === TRUE) {
        echo "Record updated successfully";
        header("Location: home.php"); // Redirect back to the profile page after updating
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$sql = "SELECT * FROM worker_insert WHERE worker_email = '" . $_SESSION['worker_email'] . "'";
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .container form input,
        .container form select {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .container form select {
            height: 40px;
        }

        .container form input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        .container form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container form label {
            text-align: left;
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: left;

        }
    </style>
    <title>Update Profile</title>
</head>
<body>
    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Worker Name:</label>
            <input type="text" name="worker_name" placeholder="Enter Worker Name" value="<?php echo $row['worker_name']; ?>"><br>
            <label>Mobile Number:</label>
            <input type="text" name="worker_mobile_number" placeholder="Enter Mobile Number" value="<?php echo $row['worker_mobile_number']; ?>"><br>
            <label>Age:</label>
            <input type="number" name="worker_age" placeholder="Enter Age" value="<?php echo $row['worker_age']; ?>"><br>
            <label>Salary:</label>
            <input type="text" name="worker_salary" placeholder="Enter Salary" value="<?php echo $row['worker_salary']; ?>"><br>
            <label>Availability:</label>
<select name="worker_available">
    <option value="yes" <?php if ($row['worker_available'] === 'yes') echo 'selected'; ?>>Yes</option>
    <option value="no" <?php if ($row['worker_available'] === 'no') echo 'selected'; ?>>No</option>
</select><br>

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