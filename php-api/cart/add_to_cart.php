<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

$database = new Database();
$db = $database->connect();

if (!$db) {
    http_response_code(500);
    echo json_encode(["message" => "Failed Connection."]);
    exit; 
}

// JSON data from the request body
$data = json_decode(file_get_contents("php://input"));


if (isset($data->selectedProductId)) {
    // Retrieve the selectedProductId
    $selectedProductId = $data->selectedProductId;
    $cartService = new CartService($db);
    $result = $cartService->addToCart($selectedProductId); 

    echo json_encode($result);
}

else {
    http_response_code(400); 
    echo json_encode(["message" => "Product ID is missing in the request body."]);
}
?>
