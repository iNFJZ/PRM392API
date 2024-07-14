<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

$email = isset($_POST['email']) ? $_POST['email'] : '';

if (empty($email)) {
    $response = array(
        'error' => true,
        'message' => 'Email not provided'
    );
    echo json_encode($response);
    exit;
}

$sql = "SELECT * FROM Accounts WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $reset_code = rand(100000, 999999);
    $reset_code_created_at = date("Y-m-d H:i:s");

    $sql = "UPDATE Accounts SET reset_code = ?, reset_code_created_at = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $reset_code, $reset_code_created_at, $email);
    if ($stmt->execute()) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ilubeos@gmail.com';
            $mail->Password = 'mycd hnpb woeu thuj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@example.com', 'Mailer');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Code';
            $mail->Body    = 'Your password reset code is: ' . $reset_code;

            $mail->send();
            $response = array(
                'error' => false,
                'message' => 'Reset code sent to email'
            );
        } catch (Exception $e) {
            $response = array(
                'error' => true,
                'message' => 'Failed to send email. Mailer Error: ' . $mail->ErrorInfo
            );
        }
    } else {
        $response = array(
            'error' => true,
            'message' => 'Failed to update reset code in database'
        );
    }
} else {
    $response = array(
        'error' => true,
        'message' => 'Email not found'
    );
}

echo json_encode($response);
$conn->close();
?>
