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

// Get ProductID from the request
$productID = isset($_GET['ProductID']) ? intval($_GET['ProductID']) : 0;

if ($productID > 0) {
    // SQL query to fetch product details
    $sql = "SELECT * FROM products WHERE ProductID = $productID";

    // Execute query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $json = json_encode($row, JSON_PRETTY_PRINT); // Convert data to JSON with pretty print
    } else {
        $json = json_encode(array("message" => "Product not found")); // Return message if no results
    }
} else {
    $json = json_encode(array("message" => "Invalid ProductID")); // Return message if ProductID is not valid
}

// Print data
echo $json;

// Close connection
$conn->close();
?>
