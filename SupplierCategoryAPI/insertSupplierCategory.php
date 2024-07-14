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
if (isset($_POST['CategoryName'])) {
    $CategoryName = $_POST['CategoryName'];

    // SQL
    $sql = "INSERT INTO suppliercategories (CategoryName) VALUES ('$CategoryName')";
    
    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "CategoryName is missing";
}

$conn->close();
?>
