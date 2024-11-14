<?php
session_start();
if (!isset($_SESSION['shop_email'])) {
    header("Location: side_loginshop.php"); // Redirect to the login page if not logged in
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
     $shop_name = mysqli_real_escape_string($conn, $_POST['shop_name']);
    $job_name = mysqli_real_escape_string($conn, $_POST['job_name']);
    $shopkeeper_name = mysqli_real_escape_string($conn, $_POST['shopkeeper_name']);
    $age_required = mysqli_real_escape_string($conn, $_POST['age_required']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $requirements = mysqli_real_escape_string($conn, $_POST['requirements']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $time_in = mysqli_real_escape_string($conn, $_POST['time_in']);
    $time_out = mysqli_real_escape_string($conn, $_POST['time_out']);
    $shop_available = mysqli_real_escape_string($conn, $_POST['shop_available']);

    // Update shop data in the database
    $update_query = "UPDATE shop_insert SET 
                        shop_name='$shop_name',
                        shop_job_name='$job_name',
                        shopkeeper_name='$shopkeeper_name',
                        shop_age_required='$age_required',
                        shop_mobile_number='$mobile_number',
                        shop_requirements='$requirements',
                        shop_address='$address',
                        time_in='$time_in',
                        time_out='$time_out',
                        shop_available='$shop_available'
                        WHERE shop_email='" . $_SESSION['shop_email'] . "'";

    if ($conn->query($update_query) === TRUE) {
        echo "Record updated successfully";
        header("Location: home.php"); // Redirect back to the profile page after updating
    } else {
        echo "Error updating record: " . $conn->error;
    }

}

$sql = "SELECT * FROM shop_insert WHERE shop_email = '" . $_SESSION['shop_email'] . "'";
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

        .container form input ,
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
        }
    </style>
      
    <title>Update Profile</title>
</head>
<body>  
<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Shop Name:</label>
        <input type="text" name="shop_name" placeholder="Enter Shop Name" value="<?php echo $row['shop_name']; ?>"><br>
        <label>Job Name:</label>
        <input type="text" name="job_name" placeholder="Enter Job Name" value="<?php echo $row['shop_job_name']; ?>"><br>
        <label>Shopkeeper Name:</label>
        <input type="text" name="shopkeeper_name" placeholder="Enter Shopkeeper Name" value="<?php echo $row['shopkeeper_name']; ?>"><br>
        <label>Age required:</label>
        <input type="number" name="age_required" placeholder="Enter Age required" value="<?php echo $row['shop_age_required']; ?>"><br>
        <label>Mobile number:</label>
        <input type="text" name="mobile_number" placeholder="Enter Mobile Number" value="<?php echo $row['shop_mobile_number']; ?>"><br>
        <label>Requirements:</label>
        <input type="text" name="requirements" placeholder="Enter Requirements" value="<?php echo $row['shop_requirements']; ?>"><br>
        <label>Address:</label>
        <input type="text" name="address" placeholder="Enter Address" value="<?php echo $row['shop_address']; ?>"><br>
        <label>Available Slots:</label>
            <select name="shop_available">
                <?php
                for ($i = 0; $i <= 15; $i++) {
                    echo "<option value='$i' ";
                    if ($row['shop_available'] == $i) {
                        echo "selected";
                    }
                    echo ">$i</option>";
                }
                ?>
            </select><br>

        <label>Time In:</label>
        <input type="time" name="time_in" value="<?php echo $row['time_in']; ?>"><br>
        <label>Time Out:</label>
        <input type="time" name="time_out" value="<?php echo $row['time_out']; ?>"><br>
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
