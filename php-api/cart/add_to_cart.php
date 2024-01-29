<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

$database = new Database();
$con = $database->connect();

if (!$con) {
    http_response_code(500);
    echo json_encode(["message" => "Failed to establish database connection."]);
    exit; 
}

$inputData = json_decode(file_get_contents('php://input'), true);

if (!isset($inputData['customer_id']) || !isset($inputData['product_id']) || !isset($inputData['quantity'])) {
    http_response_code(400);
    echo json_encode(["message" => "Missing required fields"]);
    exit;
}

$customer_id = $inputData['customer_id'];
$product_id = $inputData['product_id'];
$quantity = $inputData['quantity'];

$query = "INSERT INTO cart_item (customer_id, product_id, qty) VALUES (:customer_id, :product_id, :quantity)";
$stmt = $con->prepare($query);

// Use bindParam for PDO
$stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

if ($stmt->execute()) {
    http_response_code(201); // Created
    echo json_encode(["message" => "Item added to cart"]);
} else {
    http_response_code(500); 
    echo json_encode(["message" => "Error adding item to cart"]);
}

?>
