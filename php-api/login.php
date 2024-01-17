<?php
header("Access-Control-Allow-Origin: http://localhost:4200"); // Replace with your Angular application URL
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Include other allowed methods if needed

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: http://localhost:4200"); // Replace with your Angular application URL
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Access-Control-Allow-Methods: POST, OPTIONS"); // Include other allowed methods if needed
    exit();
}

include 'config/connect.php';

// Get the POST data from Angular
$data = json_decode(file_get_contents('php://input'), true);

// Extract the user data
$username = $data['username'];
$password = $data['password'];

// Validate and sanitize the user data as needed

// Prepare and execute the SQL query to fetch the user record
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

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
?>
