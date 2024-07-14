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
if (isset($_POST['CustomerID']) && isset($_POST['CustomerName']) && isset($_POST['ContactName']) && isset($_POST['Address']) && isset($_POST['City']) && isset($_POST['PostalCode']) && isset($_POST['Country']) && isset($_POST['Phone'])) {
    $CustomerID = $_POST['CustomerID'];
    $CustomerName = $_POST['CustomerName'];
    $ContactName = $_POST['ContactName'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $PostalCode = $_POST['PostalCode'];
    $Country = $_POST['Country'];
    $Phone = $_POST['Phone'];

    // SQL
    $sql = "UPDATE customers SET CustomerName = '$CustomerName', ContactName = '$ContactName', Address = '$Address', City = '$City', PostalCode = '$PostalCode', Country = '$Country', Phone = '$Phone' WHERE CustomerID = '$CustomerID'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Record updated successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $conn->error));
    }
} else {
    echo json_encode(array("message" => "Required fields are missing"));
}

$conn->close();
?>
