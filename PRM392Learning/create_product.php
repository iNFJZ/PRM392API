<?php

$response = array();

$server = "localhost";
$username = "root";
$password ="";
$database ="PRM392";

//Create connection
$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Check for required fields
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    //including db connect class
    //require_once __DIR__ . 'db_connect.php';

    //connecting to db
    //$db = new DB_CONNECT();

    //SQL
    $sql = "INSERT INTO products (name, price, description) values 
    ('$name','$price','$description')";

    if ($conn->query($sql) === true) {
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
        //Echo JSON response
        echo json_encode($response);
    }
    else {
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        //Echo JSON response
        echo json_encode($response);
    }
$conn->close();
} else {
    //Required field(s) is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    echo json_encode($response);
}

// localhost/PRM392/create_product.php
