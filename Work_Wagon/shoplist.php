<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM shop_insert WHERE status = 'added'";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Shop Name</th>
    <th>Actions</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["shop_name"]."</td>
        <td>
        <form action='accept.php' method='post'>
            <input type='hidden' name='shop_email' value='".$row['shop_email']."'>
            <div>
                <button type='submit' name='action' value='accept'><i class='fas fa-thumbs-up'></i>ACCEPT</button>
            </div>
            <div>
                <button type='submit' name='action' value='reject'>REJECT<i class='fas fa-thumbs-down'></i></button>
            </div>
        </form>
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
