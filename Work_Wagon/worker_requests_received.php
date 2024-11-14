<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-HD/pPyHY4CUp6Zjq3F+9fh6QwOJpNLeRYCEbY6ekG24cO+gnyU1Z2mOzswlv9ASz" crossorigin="anonymous">
<link rel="stylesheet" href="requestcss.css">
</head>
    <body>
<?php

session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = new mysqli($host, $username, $password, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

    if (isset($_SESSION['worker_email'])) {
        $sql = "SELECT * FROM worker_requests WHERE worker_email = '" . $_SESSION['worker_email'] . "' and shop_available!=0 and worker_available='yes'";

        
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo"<form action='shop_replies.php' method='post'>";
    
echo'<input type="hidden" name="shop_email" value="'.$row['shop_email'].'"><br>
<input type="hidden" name="worker_email" value="'.$_SESSION['worker_email'].'">';

                echo "Shop Name: " . $row["shop_name"] . "<br>";
                echo "Job Name: " . $row["shop_job_name"] . "<br>";
                echo "Shopkeeper Name: " . $row["shopkeeper_name"] . "<br>";
                echo "Age required: " . $row["shop_age_required"] . "<br>";
                echo "Category: " . $row["shop_category"] . "<br>";
                echo"  <div>
                <button type='submit' name='action' value='accept'><i class='fas fa-thumbs-up'></i>ACCEPT</button>
            </div>
            <div>
                <button type='submit' name='action' value='reject'>REJECT<i class='fas fa-thumbs-down'></i></button>
            </div></form>
            ";
            }
        } 
        else {
            echo "No requests upto now.";
        }
    } 
    else {
        echo "Session variable 'shop_email' not set.";
    }

    // Close the database connection if it's still open
    if ($conn)
     {
        $conn->close();
    }


?>
</body>
</html>