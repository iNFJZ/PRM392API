<?php
// Access full control
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Declare info of server
$server = "localhost";
$username = "root";
$password = "";
$dbname = "PRM392";

// Connect to database
$conn = new mysqli($server, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get CustomerID from the request
$customerID = isset($_GET['CustomerID']) ? intval($_GET['CustomerID']) : 0;

if ($customerID > 0) {
    // Declare a sequence
    $sql = "SELECT * FROM customers WHERE CustomerID = $customerID";

    // Get data
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $json = json_encode($row, JSON_PRETTY_PRINT); // Convert data to JSON with pretty print
    } else {
        $json = json_encode(array("message" => "Customer not found")); // Return message if no results
    }
} else {
    $json = json_encode(array("message" => "Invalid CustomerID")); // Return message if CustomerID is not valid
}

// Print data
echo $json;

// Close connection
$conn->close();
?>
