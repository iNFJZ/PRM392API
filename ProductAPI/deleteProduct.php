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
if (isset($_POST['ProductID'])) {
    $ProductID = $_POST['ProductID'];

    // SQL
    $sql = "DELETE FROM products WHERE ProductID = '$ProductID'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Product deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $conn->error));
    }
} else {
    echo json_encode(array("message" => "ProductID is missing"));
}

$conn->close();
?>
