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

    if ($action === "accept") {$updateQuery5 = "UPDATE shoprequests SET shop_available=shop_available-1 WHERE shop_email='$shop_email'";

        $updateQuery4= "UPDATE shoprequests SET worker_available='no' WHERE worker_email='$worker_email'";
        $updateQuery3= "UPDATE shop_insert SET shop_available='shop_available-1' WHERE shop_email='$shop_email'";
        $updateQuery2 = "UPDATE worker_requests SET shop_available='shop_available-1' WHERE shop_email='$shop_email'";
        $updateQuery1 = "UPDATE worker_requests SET worker_available='no' WHERE worker_email='$worker_email'";
        $updateQuery = "UPDATE worker_insert SET worker_available='no' WHERE worker_email='$worker_email'";
        $deleteQuery = "DELETE FROM worker_requests WHERE worker_email='$worker_email' and shop_email='$shop_email'";
        $selectQuery = "SELECT * FROM worker_insert WHERE worker_email='$worker_email'";
        if ($conn->query($updateQuery5) === TRUE) {
            if ($conn->query($updateQuery4) === TRUE) {
        if ($conn->query($updateQuery3) === TRUE) {
            if ($conn->query($updateQuery2) === TRUE) {
        // Execute the update query
        if ($conn->query($updateQuery1) === TRUE) {
            if ($conn->query($updateQuery) === TRUE) {
            // Execute the delete query
            if ($conn->query($deleteQuery) === TRUE) {
                // Execute the select query
                $result = $conn->query($selectQuery);

                if ($result && $result->num_rows == 1) {
                    // Output data of the selected row
                    $row = $result->fetch_assoc();
                    $worker_name = $row["worker_name"];
                    $worker_email = $row["worker_email"];
                    $worker_mobile_number = $row["worker_mobile_number"];

                    // Insert data into the table
                    $insertQuery = "INSERT INTO shop_replies (worker_name, worker_email, worker_mobile_number, worker_message, shop_email)
                                    VALUES ('$worker_name', '$worker_email', '$worker_mobile_number', 'ACCEPTED', '$shop_email')";

                    if ($conn->query($insertQuery) === TRUE) {
                        echo "reply sent";
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
        } else {
            echo "Error updating record: " . $conn->error;
        }}}}}}
    } elseif ($action === "reject") {
        $deleteQuery = "DELETE FROM worker_requests WHERE worker_email='$worker_email'";
        $selectQuery = "SELECT * FROM worker_insert WHERE worker_email='$worker_email'";

        // Execute the delete query
        if ($conn->query($deleteQuery) === TRUE) {
            // Execute the select query
            $result = $conn->query($selectQuery);

            if ($result && $result->num_rows == 1) {
                // Output data of the selected row
                $row = $result->fetch_assoc();
                $worker_name = $row["worker_name"];
                $worker_email = $row["worker_email"];
                $worker_mobile_number = $row["worker_mobile_number"];

                // Insert data into the table
                $insertQuery = "INSERT INTO shop_replies (worker_name, worker_email, worker_mobile_number, worker_message, shop_email)
                                VALUES ('$worker_name', '$worker_email', '$worker_mobile_number', 'REJECTED', '$shop_email')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "Replies sent";
                } else {
                    echo "Unknown problem";
                }
            } else {
                echo "Unknown problem";
            }
        } else {
            echo "Unable to process know" ;
        }
    }

    // Close the database connection
    $conn->close();
}
?>
