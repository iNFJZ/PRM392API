<?php
$server = "localhost";
$username = "root";
$password ="";
$database ="PRM392";

//Create connection
$conn = new mysqli($server, $username, $password, $database);

//Check for required fields
if (isset($_GET['id'])){

    $id = $_GET['id'];

    //SQL
    $sql = "DELETE FROM products WHERE id = '$id'";
    if ($conn->query($sql) === true) {
        echo "New record deleted successfully";
    }
    else {
        echo "Error: ".$conn->error;
    }
}
$conn->close();
// http://localhost/PRM392/delete.php?id=5
