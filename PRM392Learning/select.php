<?php
//Access full control
header('Access-Control-Allow-OriginL *');

//Declare info of server
$server = "localhost";
$username = "root";
$password = "";
$dbname = "PRM392";

//Connect to database
$conn = new mysqli($server, $username, $password, $dbname);

//Declare a sequence 
$sql = "SELECT * FROM mytable";

//Get data
$result = $conn->query($sql);

while($row[]=$result->fetch_assoc()){
    $json = json_encode($row); //Convert data to json
}

//Print data
echo '{"products":'.$json.'}';

//Close connection
$conn->close();
