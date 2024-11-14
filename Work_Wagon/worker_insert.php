<html>
<head>
    <link rel="stylesheet" href="login.css">
</head>
<body>
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

    // Process the form data
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];
    $available = $_POST['available'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $work_known = $_POST['work_known'];
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $image_folder = "images/";
    move_uploaded_file($image_temp, $image_folder . $image);

    // Insert data into the table
    $sql = "INSERT INTO worker_insert (worker_name, worker_mobile_number, worker_email, worker_available, worker_age, worker_salary, worker_city, worker_password, worker_work_known, worker_image) VALUES ('$name', '$mobile_number', '$email', '$available', '$age', '$salary', '$city', '$password', '$work_known', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "Signed up successfully";
        header("refresh:0.8;url=home.php");
    } else {
        // Duplicate email or phone number
        echo "<div class='duplicate-message-container'>Duplicate email or phone number. Please use a different one.</div>";
        header("refresh:0.8;url=workers.html");
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
</body>
</html>
