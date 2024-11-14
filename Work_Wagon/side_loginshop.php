<html>
    <head><link rel="stylesheet" href="login.css">
</head>
<body><?php
session_start();
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shop_email = $_POST["shop_email"];
    $shop_password = $_POST["shop_password"];
    $shop_mobile_number = $_POST["shop_mobile_number"];

    $sql = "SELECT * FROM shop_insert WHERE shop_email = '$shop_email' AND shop_password = '$shop_password' And shop_mobile_number='$shop_mobile_number'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
        $user = $result->fetch_assoc();
        $_SESSION['shop_name'] = $user['shop_name'];
        $_SESSION['shop_email'] = $user['shop_email'];
        $_SESSION['shop_mobile_number'] = $user['shop_mobile_number'];
        
        $_SESSION['shop_available'] = $user['shop_available'];
      

        header("Location: home.php");
        exit();
    }  else {
        // Authentication failed
        echo "<div class='error-message-container'>Invalid email or password. Please try again.</div>";
        
        header("refresh:0.8;url=sidebar_loginshop.html"); 
    }
}
?></body>
</html>
