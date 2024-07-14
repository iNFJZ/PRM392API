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
if (isset($_POST['SupplierName']) && isset($_POST['ContactName']) && isset($_POST['Address']) && isset($_POST['City']) && isset($_POST['PostalCode']) && isset($_POST['Country']) && isset($_POST['Phone']) && isset($_POST['CategoryID'])) {
    $SupplierName = $_POST['SupplierName'];
    $ContactName = $_POST['ContactName'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $PostalCode = $_POST['PostalCode'];
    $Country = $_POST['Country'];
    $Phone = $_POST['Phone'];
    $CategoryID = $_POST['CategoryID'];

    // SQL
    $sql = "INSERT INTO suppliers (SupplierName, ContactName, Address, City, PostalCode, Country, Phone, CategoryID) VALUES ('$SupplierName', '$ContactName', '$Address', '$City', '$PostalCode', '$Country', '$Phone', '$CategoryID')";
    
    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Required fields are missing";
}

$conn->close();
?>
