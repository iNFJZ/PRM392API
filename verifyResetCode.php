<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$server = "localhost";
$username = "root";
$password = "";
$dbname = "PRM392";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$code = $_POST['code'];

$sql = "SELECT reset_code_created_at FROM Accounts WHERE reset_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $code);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($reset_code_created_at);
$stmt->fetch();

if ($stmt->num_rows > 0) {
    // Calculate difference in minutes
    $reset_code_created_time = strtotime($reset_code_created_at);
    $current_time = time();
    $diff = ($current_time - $reset_code_created_time) / 60; // in minutes

    // Adjust the expiration window as needed, here set to 30 minutes
    $expirationWindow = 30; // in minutes
    if ($diff <= $expirationWindow) {
        $response = array(
            'error' => false,
            'message' => 'Code verified'
        );
    } else {
        $response = array(
            'error' => true,
            'message' => 'Expired code'
        );
    }
} else {
    $response = array(
        'error' => true,
        'message' => 'Invalid code'
    );
}

echo json_encode($response);
$stmt->close();
$conn->close();
?>
