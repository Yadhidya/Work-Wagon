<?php
// Establish a connection to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$host = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = new mysqli($host, $username, $password, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$shop_email = $_POST['shop_email'];
$worker_email = $_POST['worker_email'];

$sql = "SELECT * FROM worker_insert WHERE worker_email = '$worker_email'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    // Output data of the selected row
    $row = $result->fetch_assoc();
    $worker_name = $row["worker_name"];
    $worker_expected_salary = $row["worker_salary"];
    $worker_work_known = $row["worker_work_known"];
    $worker_age = $row["worker_age"];
    $worker_city = $row["worker_city"];
    $worker_email = $row["worker_email"];
    $worker_available= $row["worker_available"];

    // Insert data into the table
    $sql = "INSERT INTO shoprequests (worker_name, worker_expected_salary, worker_work_known, worker_age, worker_city,worker_email,worker_available, shop_email)
    VALUES ('$worker_name', '$worker_expected_salary', '$worker_work_known', '$worker_age', '$worker_city','$worker_email',' $worker_available', '$shop_email')";

    if ($conn->query($sql) === TRUE) {
        echo "Request sent";
        header("refresh:0.8;url=home.php");
    }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $sql1 = "SELECT * FROM shop_insert WHERE shop_email = '$shop_email'";
    $result1 = $conn->query($sql1);
    
    if ($result1 && $result1->num_rows == 1) {
        // Output data of the selected row
        $row = $result1->fetch_assoc();
        
        $shop_available=$row["shop_available"];
        $sql1="update   shoprequests set shop_available='$shop_available' where shop_email='$shop_email'";
        if ($conn->query($sql1) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
} }else {
    echo "Unable to send request";
}

// ... rest of your code ...


    

    // Close the database connection
    mysqli_close($conn);

?>
