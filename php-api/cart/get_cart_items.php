<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/CartItem.php'; 

$database = new Database();
$db = $database->connect();


$customerId = 1; // For testing purposes, MUST CHANGE WHEN USER CLASS IS CREATED

$query = "SELECT ci.quantity, p.* FROM cart_item ci 
          JOIN products p ON ci.product_id = p.product_id 
          WHERE ci.customer_id = :customer_id";

$stmt = $db->prepare($query);
$stmt->bindParam(':customer_id', $customerId, PDO::PARAM_INT);
$stmt->execute();

$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($cartItems);
