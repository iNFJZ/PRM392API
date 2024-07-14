<?php
$server = "localhost";
$username = "root";
$password ="";
$database ="PRM392";

//Create connection
$conn = new mysqli($server, $username, $password, $database);

//Check for required fields
if (isset($_GET['first_name']) && isset($_GET['last_name']) && isset($_GET['email'])){
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $email = $_GET['email'];

    
    //SQL
    $sql = "INSERT INTO products (first_name, last_name, email) values 
    ('$first_name','$last_name','$email')";
    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    }
    else {
        echo "Error: ".$conn->error;
    }
}
$conn->close();
// http://localhost/PRM392/insert.php?first_name=Nguyen&&last_name=Tien Dung&&email=ilubeos@gmail.com
