<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$server = "localhost";
$username = "root";
$password = "";
$dbname = "PRM392";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array('error' => true, 'message' => 'Connection failed: ' . $conn->connect_error)));
}

try {
    // Lấy dữ liệu từ POST request
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) {
        throw new Exception('Invalid JSON');
    }
    
    $password = mysqli_real_escape_string($conn, $data['password']);
    $resetCode = mysqli_real_escape_string($conn, $data['code']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra reset_code trong cơ sở dữ liệu
    $sql = "SELECT id, reset_code_created_at FROM Accounts WHERE reset_code = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare statement failed: ' . $conn->error);
    }
    
    $stmt->bind_param("s", $resetCode);
    if (!$stmt->execute()) {
        throw new Exception('Execute statement failed: ' . $stmt->error);
    }
    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $accountId = $row['id'];
        $resetCodeCreatedAt = $row['reset_code_created_at'];
        
        // Tính toán thời gian khác biệt
        $current_time = new DateTime();
        $reset_code_time = new DateTime($resetCodeCreatedAt);
        $diff = $current_time->diff($reset_code_time)->i;

        $response = array(
            'reset_code_created_at' => $resetCodeCreatedAt,
            'current_time' => $current_time->format('Y-m-d H:i:s'),
            'diff' => $diff
        );

        if ($diff <= 10) {
            // Cập nhật mật khẩu mới vào cơ sở dữ liệu
            $sqlUpdate = "UPDATE Accounts SET password = ?, reset_code = NULL, reset_code_created_at = NULL WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            if (!$stmtUpdate) {
                throw new Exception('Prepare update statement failed: ' . $conn->error);
            }
            
            $stmtUpdate->bind_param("si", $hashed_password, $accountId);
            if (!$stmtUpdate->execute()) {
                throw new Exception('Execute update statement failed: ' . $stmtUpdate->error);
            }
            
            $response['error'] = false;
            $response['message'] = 'Password updated successfully';
        } else {
            $response['error'] = true;
            $response['message'] = 'Invalid or expired reset code';
        }
    } else {
        $response = array(
            'error' => true,
            'message' => 'Invalid or expired reset code'
        );
    }

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(array('error' => true, 'message' => $e->getMessage()));
}
$conn->close();
?>
