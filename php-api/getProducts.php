<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'config/Database.php';

$database = new Database();
$con = $database->connect();

if (!isset($con)) {
    http_response_code(500);
    echo json_encode(["message" => "Failed to establish database connection."]);
    exit; 
}



$type = isset($_GET['type']) ? $_GET['type'] : 'all';

switch ($type) {
    case 'most_selling':
        $query = "SELECT * FROM products DESC LIMIT 3"; 
        break;
    case 'most_recent':
        $query = "SELECT * FROM products DESC LIMIT 2"; 
        break;
    default:
        $query = "SELECT * FROM products";
        break;
}


$stmt = $con->prepare($query);
$stmt->execute();

$products = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $products[] = $row;
}

$stmt->closeCursor(); // Use closeCursor() for PDO instead of close()
$con = null; // Use null assignment for closing PDO connection

echo json_encode($products);

