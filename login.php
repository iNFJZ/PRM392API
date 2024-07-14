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

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $input = json_decode(file_get_contents('php://input'), true);
    $username = $input['username'];
    $password = $input['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM Accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify the password
    if ($hashed_password && password_verify($password, $hashed_password)) {
        $response = array(
            'error' => false,
            'message' => 'Login successful!'
        );
    } else {
        $response = array(
            'error' => true,
            'message' => 'Invalid username or password!'
        );
    }

    // Close statement
    $stmt->close();
} else {
    $response = array(
        'error' => true,
        'message' => 'Invalid request method!'
    );
}

// Print response as JSON
echo json_encode($response);

// Close connection
$conn->close();
?>
