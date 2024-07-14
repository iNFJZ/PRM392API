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
if (isset($_POST['OrderDetailID']) && isset($_POST['OrderID']) && isset($_POST['ProductID']) && isset($_POST['Quantity']) && isset($_POST['UnitPrice'])) {
    $OrderDetailID = $_POST['OrderDetailID'];
    $OrderID = $_POST['OrderID'];
    $ProductID = $_POST['ProductID'];
    $Quantity = $_POST['Quantity'];
    $UnitPrice = $_POST['UnitPrice'];

    // SQL
    $sql = "UPDATE orderdetails SET OrderID = '$OrderID', ProductID = '$ProductID', Quantity = '$Quantity', UnitPrice = '$UnitPrice' WHERE OrderDetailID = '$OrderDetailID'";
    
    if ($conn->query($sql) === true) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Required fields are missing";
}

$conn->close();
?>
