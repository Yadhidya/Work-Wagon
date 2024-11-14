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


$sql = "SELECT * FROM shop_insert WHERE shop_email = '$shop_email'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    // Output data of the selected row
    $row = $result->fetch_assoc();
    $shop_name=$row["shop_name"];
    $shop_job_name=$row["shop_job_name"];
    $shopkeeper_name=$row["shopkeeper_name"];
    $shop_age_required=$row["shop_age_required"];
    $shop_category=$row["shop_category"];
    $shop_available=$row["shop_available"];
    $time_in=$row["time_in"];
    $time_in_ampm=$row["time_in_ampm"];
    $time_out=$row["time_out"];
    $time_out_ampm=$row["time_out_ampm"];
    $shop_salary=$row["shop_salary"];
    $shop_requirements=$row["shop_requirements"];
    $shop_address=$row["shop_address"];
    $shop_city=$row["shop_city"];
    $shop_email=$row["shop_email"];
    $sql = "INSERT INTO worker_requests (shop_name,shop_job_name,shopkeeper_name,shop_age_required,shop_category,time_in,time_in_ampm,time_out,time_out_ampm,shop_salary,shop_requirements,shop_address,shop_city,shop_email,shop_available,worker_email)
    VALUES ('$shop_name','$shop_job_name','$shopkeeper_name','$shop_age_required','$shop_category','$time_in','$time_in_ampm','$time_out','$time_out_ampm','$shop_salary','$shop_requirements','$shop_address','$shop_city','$shop_email','$shop_available','$worker_email')";

    if ($conn->query($sql) === TRUE) {
        echo "request sent";
        header("refresh:0.6;url=home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} $sql1 = "SELECT * FROM worker_insert WHERE worker_email = '$worker_email'";
$result1 = $conn->query($sql1);

if ($result1 && $result1->num_rows == 1) {
    // Output data of the selected row
    $row = $result1->fetch_assoc();
    
    $worker_available=$row["worker_available"];
    $sql1="update   worker_requests set worker_available='$worker_available' where worker_email='$worker_email'";
    if ($conn->query($sql1) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else {
    echo "unable to process";
}

// ... rest of your code ...


    

    // Close the database connection
    mysqli_close($conn);
}
?>
