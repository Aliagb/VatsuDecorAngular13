<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/Database.php';
include_once '../models/Product.php';

$database = new Database();
$con = $database->connect();

if (!$con) {
    echo json_encode(["message" => "Failed to connect to the database"]);
    exit;
}

$product = new Product($con);

$product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();

$product->getProductById();

if($product->name != null){
    $product_arr = array(
        "product_id" =>  $product->product_id,
        "name" => $product->name,
        "description" => $product->description,
        "qty" => $product->qty,
        "price" => $product->price
    );

    http_response_code(200);

    echo json_encode($product_arr);
} else{
    http_response_code(404);

    echo json_encode(array("message" => "Product does not exist."));
}
?>