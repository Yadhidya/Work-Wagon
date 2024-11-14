<?php
// Establish a connection to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "project";

    $conn = new mysqli($host, $username, $password, $database);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $shop_email = $_POST['shop_email'];
    $worker_email = $_POST['worker_email'];
    $action = $_POST["action"];

    if ($action === "accept") {
        $updateQuery2 = "UPDATE worker_requests SET worker_available='no' WHERE worker_email='$worker_email'";
        $updateQuery3 = "UPDATE worker_requests SET shop_available = shop_available - 1 WHERE shop_email='$shop_email'";
        $updateQuery4 = "UPDATE shoprequests SET shop_available = shop_available - 1 WHERE shop_email='$shop_email'";
        $updateQuery5 = "UPDATE shoprequests SET worker_available='no' WHERE worker_email='$worker_email'";
        $updateQuery1 = "UPDATE worker_insert SET worker_available='no' WHERE worker_email='$worker_email'";
        $updateQuery = "UPDATE shop_insert SET shop_available = shop_available - 1 WHERE shop_email='$shop_email'";
        $deleteQuery = "DELETE FROM shoprequests WHERE shop_email='$shop_email' AND worker_email='$worker_email'";
        $selectQuery = "SELECT * FROM shop_insert WHERE shop_email='$shop_email'";

        // Execute the update query
        if ($conn->query($updateQuery1) === TRUE &&
            $conn->query($updateQuery2) === TRUE &&
            $conn->query($updateQuery3) === TRUE &&
            $conn->query($updateQuery4) === TRUE &&
            $conn->query($updateQuery5) === TRUE &&
            $conn->query($updateQuery) === TRUE) {

            // Execute the delete query
            if ($conn->query($deleteQuery) === TRUE) {
                // Execute the select query
                $result = $conn->query($selectQuery);

                if ($result && $result->num_rows == 1) {
                    // Output data of the selected row
                    $row = $result->fetch_assoc();
                    $shop_name = $row["shop_name"];
                    $shop_keeper_name = $row["shopkeeper_name"];
                    $shop_mobile_number = $row["shop_mobile_number"];

                    // Insert data into the table
                    $insertQuery ="INSERT INTO worker_replies (shop_name, shop_email, shop_mobile_number, shop_message, shop_keeper_name, worker_email)
                                    VALUES ('$shop_name', '$shop_email', '$shop_mobile_number', 'ACCEPTED', '$shop_keeper_name', '$worker_email')";

                    if ($conn->query($insertQuery) === TRUE) {
                        echo "Signed up successfully";
                    } else {
                        echo "Error: " . $insertQuery . "<br>" . $conn->error;
                    }
                } else {
                    echo "No results found for the given worker email.";
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif ($action === "reject") {
        $deleteQuery = "DELETE FROM shoprequests WHERE shop_email='$shop_email'";
        $selectQuery = "SELECT * FROM shop_insert WHERE shop_email='$shop_email'";

        // Execute the delete query
        if ($conn->query($deleteQuery) === TRUE) {
            // Execute the select query
            $result = $conn->query($selectQuery);

            if ($result && $result->num_rows == 1) {
                // Output data of the selected row
                $row = $result->fetch_assoc();
                $shop_name = $row["shop_name"];
                $shop_keeper_name = $row["shopkeeper_name"];
                $shop_mobile_number = $row["shop_mobile_number"];

                // Insert data into the table
                $insertQuery = "INSERT INTO worker_replies (shop_name, shop_email, shop_mobile_number, shop_message, shop_keeper_name, worker_email)
                                VALUES ('$shop_name', '$shop_email', '$shop_mobile_number', 'REJECTED', '$shop_keeper_name', '$worker_email')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "Reply sent";
                    header("refresh:1;url=home.php");
                } else {
                    echo "Error: " . $insertQuery . "<br>" . $conn->error;
                }
            } else {
                echo "No results found for the given worker email.";
            }
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>
