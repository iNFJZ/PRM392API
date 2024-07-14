<?php
header('Content-Type: application/json');

$server = "localhost";
$username = "root";
$password = "";
$database = "PRM392";

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connection failed: " . $conn->connect_error)));
}

// Check for required fields
if (isset($data['productName']) && isset($data['supplierID']) && isset($data['categoryID']) && isset($data['unitPrice']) && isset($data['unitsInStock'])) {
    $productName = $data['productName'];
    $supplierID = $data['supplierID'];
    $categoryID = $data['categoryID'];
    $unitPrice = $data['unitPrice'];
    $unitsInStock = $data['unitsInStock'];

    // SQL to insert product
    $sql = "INSERT INTO products (ProductName, SupplierID, CategoryID, UnitPrice, UnitsInStock) 
            VALUES ('$ProductName', '$SupplierID', '$CategoryID', '$UnitPrice', '$UnitsInStock')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true, "message" => "Product added successfully"));
    } else {
        echo json_encode(array("success" => false, "message" => "Error: " . $conn->error));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Required fields are missing"));
}

$conn->close();
?>
