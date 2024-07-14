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
if (isset($_POST['CategoryID']) && isset($_POST['CategoryName'])) {
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

    // SQL
    $sql = "UPDATE suppliercategories SET CategoryName = '$CategoryName' WHERE CategoryID = '$CategoryID'";
    
    if ($conn->query($sql) === true) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Required fields are missing";
}

$conn->close();
?>
