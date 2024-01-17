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

include 'config/Database.php';


$data = json_decode(file_get_contents('php://input'), true);

// Extract the user data
$username = $data['username'];
$email = $data['email'];
$password = $data['password'];

if (empty($username) || empty($email) || empty($password)) {
    // Return an error response
    http_response_code(400);
    echo json_encode(['message' => 'Incomplete user data.']);
    exit();
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashedPassword);

if ($stmt->execute()) {
    // Return a success response
    http_response_code(200);
    echo json_encode(['message' => 'User registered successfully.']);
} else {
    // Return an error response
    http_response_code(500);
    echo json_encode(['message' => 'Failed to register user.']);
}

$stmt->close();

$conn->close();
?>
