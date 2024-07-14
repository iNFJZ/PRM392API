<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "PRM392";

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for required fields
if (isset($_POST['OrderID'])) {
    $OrderID = $_POST['OrderID'];

    // SQL
    $sql = "DELETE FROM orders WHERE OrderID = '$OrderID'";
    
    if ($conn->query($sql) === true) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "OrderID is missing";
}

$conn->close();
?>
