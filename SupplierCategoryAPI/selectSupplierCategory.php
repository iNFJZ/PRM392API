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

// Declare a sequence
$sql = "SELECT * FROM suppliercategories";

// Get data
$result = $conn->query($sql);

$rows = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rows[] = $row; // Store each row of data
    }
    $json = json_encode($rows, JSON_PRETTY_PRINT); // Convert data to JSON with pretty print
} else {
    $json = json_encode(array()); // Return empty JSON array if no results
}

// Print data
echo '{"suppliercategories":'.$json.'}';

// Close connection
$conn->close();
?>
