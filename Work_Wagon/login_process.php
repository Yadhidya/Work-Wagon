<html>
<head>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <?php
    session_start();
    require_once('db_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["pswd"];

        $sql = "SELECT * FROM normal_login WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if ($email == "rrr@gmail.com" && $password == '12345678') {
                // Admin authentication successful
                $_SESSION['email'] = $email;
                
                header("location: admin.php");
                exit();
            } else {
                // Regular user authentication successful
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['mobile_number'] = $user['mobile_number'];

                header("location: home.php");
                exit();
            }
        } else {
            // Authentication failed
            echo "<div class='error-message-container'>Invalid email or password. Please try again.</div>";
            header("refresh:0.8;url=index.php");
            exit();
        }
    }
    ?>
</body>
</html>
