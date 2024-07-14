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
if (isset($_POST['OrderID']) && isset($_POST['ProductID']) && isset($_POST['Quantity']) && isset($_POST['UnitPrice'])) {
    $OrderID = $_POST['OrderID'];
    $ProductID = $_POST['ProductID'];
    $Quantity = $_POST['Quantity'];
    $UnitPrice = $_POST['UnitPrice'];

    // SQL
    $sql = "INSERT INTO orderdetails (OrderID, ProductID, Quantity, UnitPrice) VALUES ('$OrderID', '$ProductID', '$Quantity', '$UnitPrice')";
    
    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Required fields are missing";
}

$conn->close();
?>
