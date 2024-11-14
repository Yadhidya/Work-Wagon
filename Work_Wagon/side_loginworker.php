<html>
    <head><link rel="stylesheet" href="login.css">
</head>
<body><?php
session_start();
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $worker_email = $_POST["worker_email"];
    $worker_password = $_POST["worker_password"];
    $worker_mobile_number = $_POST["worker_mobile_number"];

    $sql = "SELECT * FROM worker_insert WHERE worker_email = '$worker_email' AND worker_password = '$worker_password' And worker_mobile_number='$worker_mobile_number'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
        $user = $result->fetch_assoc();
        $_SESSION['worker_name'] = $user['worker_name'];
        $_SESSION['worker_email'] = $user['worker_email'];
        $_SESSION['worker_mobile_number'] = $user['worker_mobile_number'];
        
        $_SESSION['worker_available'] = $user['worker_available'];
      

        header("Location: home.php");
        exit();
    }  else {
        // Authentication failed
        echo "<div class='error-message-container'>Invalid email or password. Please try again.</div>";
        
        header("refresh:0.8;url=home.php"); 
    }
}
?></body>
</html>
