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
if (isset($_POST['CustomerID'])) {
    $CustomerID = $_POST['CustomerID'];

    // SQL
    $sql = "DELETE FROM customers WHERE CustomerID = '$CustomerID'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Record deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $conn->error));
    }
} else {
    echo json_encode(array("message" => "CustomerID is missing"));
}

$conn->close();
?>
