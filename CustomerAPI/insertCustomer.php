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
if (isset($_POST['CustomerName']) && isset($_POST['ContactName']) && isset($_POST['Address']) && isset($_POST['City']) && isset($_POST['PostalCode']) && isset($_POST['Country']) && isset($_POST['Phone'])) {
    $CustomerName = $_POST['CustomerName'];
    $ContactName = $_POST['ContactName'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $PostalCode = $_POST['PostalCode'];
    $Country = $_POST['Country'];
    $Phone = $_POST['Phone'];

    // SQL
    $sql = "INSERT INTO customers (CustomerName, ContactName, Address, City, PostalCode, Country, Phone) VALUES ('$CustomerName', '$ContactName', '$Address', '$City', '$PostalCode', '$Country', '$Phone')";
    
    if ($conn->query($sql) === true) {
        echo json_encode(array("success" => true, "message" => "New record created successfully"));
    } else {
        echo json_encode(array("success" => false, "message" => "Error: " . $conn->error));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Required fields are missing"));
}

$conn->close();
?>
