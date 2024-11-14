<html>
    <head><link rel="stylesheet" href="login.css">
</head>
<body>
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "project";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the POST request
    $name = $_POST['txt'];
    $email = $_POST['email'];
    $mobile_number = $_POST['number'];
    $password = $_POST['pswd'];

    // SQL query to insert data into the "shop" table
    $sql = "INSERT INTO normal_login (name, email, mobile_number, password) VALUES ('$name', '$email', '$mobile_number', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "signed up  successfully";
        header("refresh:2;url=home.php"); // Redirect to the same page after 5 seconds
    }else {
        // Duplicate email or phone number
        echo "<div class='duplicate-message-container'>Duplicate email or phone number. Please use a different one.</div>";
        
        header("refresh:0.8;url=index.php"); 
    }
    

    // Close the database connection
    $conn->close();
}
?>
</body>
</html>