<?php
header("Access-Control-Allow-Origin: http://localhost:4200"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS"); 

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: http://localhost:4200"); 
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Access-Control-Allow-Methods: POST, OPTIONS"); 
    exit();
}

include 'config/connect.php';

$data = json_decode(file_get_contents('php://input'), true);

// Extract the user data
$username = $data['username'];
$password = $data['password'];


$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  
  // Verify the provided password
  if (password_verify($password, $user['password'])) {
    // Successful login
    http_response_code(200);
    echo json_encode(['message' => 'Login successful']);
  } else {
    // Authentication failure
    http_response_code(401);
    echo json_encode(['message' => 'Invalid credentials']);
  }
} else {
  // Authentication failure
  http_response_code(401);
  echo json_encode(['message' => 'Invalid credentials']);
}

$stmt->close();

$conn->close();
?>
