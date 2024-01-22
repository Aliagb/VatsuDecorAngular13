<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include '../config/Database.php';
 
$database = new Database();
$con = $database->connect();

if (!$con) {
    echo json_encode(["message" => "Failed to connect to the database"]);
    exit;
}
// fetch all data 
$query = "SELECT product_id, name, description, qty, price, img FROM products ORDER BY product_id ASC";
$stmt = $con->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);

echo $json;
?>
