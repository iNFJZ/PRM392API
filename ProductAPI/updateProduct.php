<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$server = "localhost";
$username = "root";
$password = "";
$database = "PRM392";

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("message" => "Connection failed: " . $conn->connect_error)));
}

// Check for required fields
if (isset($_POST['ProductID']) && isset($_POST['ProductName']) && isset($_POST['SupplierID']) && isset($_POST['CategoryID']) && isset($_POST['QuantityPerUnit']) && isset($_POST['UnitPrice']) && isset($_POST['UnitsInStock']) && isset($_POST['UnitsOnOrder']) && isset($_POST['ReorderLevel']) && isset($_POST['Discontinued'])) {
    $ProductID = $_POST['ProductID'];
    $ProductName = $_POST['ProductName'];
    $SupplierID = $_POST['SupplierID'];
    $CategoryID = $_POST['CategoryID'];
    $QuantityPerUnit = $_POST['QuantityPerUnit'];
    $UnitPrice = $_POST['UnitPrice'];
    $UnitsInStock = $_POST['UnitsInStock'];
    $UnitsOnOrder = $_POST['UnitsOnOrder'];
    $ReorderLevel = $_POST['ReorderLevel'];
    $Discontinued = $_POST['Discontinued'];

    // SQL query to update product
    $sql = "UPDATE products SET ProductName = '$ProductName', SupplierID = '$SupplierID', CategoryID = '$CategoryID', QuantityPerUnit = '$QuantityPerUnit', UnitPrice = '$UnitPrice', UnitsInStock = '$UnitsInStock', UnitsOnOrder = '$UnitsOnOrder', ReorderLevel = '$ReorderLevel', Discontinued = '$Discontinued' WHERE ProductID = '$ProductID'";
    
    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Record updated successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $conn->error));
    }
} else {
    echo json_encode(array("message" => "Required fields are missing"));
}

// Close connection
$conn->close();
?>
