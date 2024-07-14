<?php
$server = "localhost";
$username = "root";
$password ="";
$database ="PRM392";

//Create connection
$conn = new mysqli($server, $username, $password, $database);

//Check for required fields
if (isset($_GET['first_name']) && isset($_GET['last_name']) && isset($_GET['email']) && isset($_GET['id'])){
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $email = $_GET['email'];
    $id = $_GET['id'];

    
    //SQL
    $sql = "UPDATE products SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = '$id'";
    if ($conn->query($sql) === true) {
        echo "New record updated successfully";
    }
    else {
        echo "Error: ".$conn->error;
    }
}
$conn->close();
// http://localhost/PRM392/update.php?first_name=Update&last_name=Tien Dung Da Duoc&email=ilubeos@gmail.com&id=5
