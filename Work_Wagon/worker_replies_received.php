<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-HD/pPyHY4CUp6Zjq3F+9fh6QwOJpNLeRYCEbY6ekG24cO+gnyU1Z2mOzswlv9ASz" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .message {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .message p {
            margin: 0;
        }
        .call-button, .email-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 10px;
        }
        .email-button {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "project";

    $conn = new mysqli($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_SESSION['worker_email'])) {
        $sql = "SELECT * FROM worker_replies WHERE worker_email = '" . $_SESSION['worker_email'] . "'";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "Shop Name: " . $row["shop_name"] . " has " . $row["shop_message"] . " your request<br>";
                if ($row["shop_message"] == "ACCEPTED") {
                    echo "<button class='email-button' onclick='sendEmail(\"" . $row["shop_email"] . "\")'>Send Email</button><br>";
                    echo "<button class='call-button' onclick='makeCall(\"" . $row["shop_mobile_number"] . "\")'>Make Phone Call</button>";
                }
            }
        } else {
            echo "No replies upto now.";
        }
    } else {
        echo "Session variable 'worker_email' not set.";
    }

    // Close the database connection if it's still open
    if ($conn) {
        $conn->close();
    }
    ?>

    <script>
       function sendEmail(email) {
    // Define the subject and body of the email
    const subject = 'Your Custom Subject';
    const body = 'Your Customized Email Body';

    // Construct the mailto URL with subject and body parameters
    const mailtoUrl = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

    // Open the user's default email client (Gmail) with pre-filled subject and body
    window.location.href = mailtoUrl;
}
function makeCall(phoneNumber) {
            // Check if the device is a mobile phone
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                // If it's a mobile device, open the phone dialer with the provided phone number
                window.location.href = 'tel:' + phoneNumber;
            } else {
                // If it's not a mobile device, show an error message
                alert('Error: This device cannot make phone calls.');
            }
        }

    </script>

</body>
</html>
