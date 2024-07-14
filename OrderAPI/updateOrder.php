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
if (isset($_POST['OrderID']) && isset($_POST['CustomerID']) && isset($_POST['OrderDate']) && isset($_POST['ShipAddress']) && isset($_POST['ShipCity']) && isset($_POST['ShipPostalCode']) && isset($_POST['ShipCountry'])) {
    $OrderID = $_POST['OrderID'];
    $CustomerID = $_POST['CustomerID'];
    $OrderDate = $_POST['OrderDate'];
    $ShipAddress = $_POST['ShipAddress'];
    $ShipCity = $_POST['ShipCity'];
    $ShipPostalCode = $_POST['ShipPostalCode'];
    $ShipCountry = $_POST['ShipCountry'];

    // SQL
    $sql = "UPDATE orders SET CustomerID = '$CustomerID', OrderDate = '$OrderDate', ShipAddress = '$ShipAddress', ShipCity = '$ShipCity', ShipPostalCode = '$ShipPostalCode', ShipCountry = '$ShipCountry' WHERE OrderID = '$OrderID'";
    
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
