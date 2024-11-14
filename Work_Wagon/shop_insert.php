<html>
    <head><link rel="stylesheet" href="login.css">
</head>
<body><?php
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
    $job_name = $_POST['job_name'];
    $shopkeeper_name = $_POST['shopkeeper_name'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];
    $available = $_POST['avalable'];
    $age_required = $_POST['age_required'];
    $time_in = $_POST['time_in'];
    $time_in_ampm = $_POST['time_in_ampm'];
    $time_out = $_POST['time_out'];
    $time_out_ampm = $_POST['time_out_ampm'];
    $salary = $_POST['salary'];
    $requirements = $_POST['requirements'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $category=$_POST['category'];
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $image_folder = "images/";
    move_uploaded_file($image_temp, $image_folder . $image);


    // Insert data into the table
    $sql = "INSERT INTO shop_insert (shop_name,shop_job_name,shopkeeper_name,shop_mobile_number,shop_email,shop_available,shop_age_required,shop_category, time_in, time_in_ampm, time_out, time_out_ampm,shop_salary,shop_requirements, shop_address,shop_city,shop_password,shop_image)
     VALUES ('$name', '$job_name', '$shopkeeper_name', '$mobile_number', '$email', '$available', '$age_required','$category', '$time_in', '$time_in_ampm', '$time_out', '$time_out_ampm', '$salary', '$requirements', '$address', '$city', '$password', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "signed up  successfully";
        header("refresh:0.8;url=home.php"); 
    } else {
        // Duplicate email or phone number
        echo "<div class='duplicate-message-container'>Duplicate email or phone number. Please use a different one.</div>";
        
        header("refresh:0.8;url=shop1.html"); 
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
</body>
</html>