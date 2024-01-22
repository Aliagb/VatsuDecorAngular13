<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

$database = new Database();
$con = $database->connect();

if (!isset($con)) {
    http_response_code(500);
    echo json_encode(["message" => "Failed to establish database connection."]);
    exit; 
}


if($_POST){


try{

$query = "INSERT INTO products SET name=:name, description=:description, qty=:qty , price=:price";

$stmt = $con->prepare($query);

// posted values
$name = $_POST['name'];
$description = $_POST['description'];
$qty = $_POST['qty'];
$price = $_POST['price'];
// bind the parameters
$stmt->bindParam(':name', $name);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':qty', $qty);
$stmt->bindParam(':price', $price);


if($stmt->execute()){
    http_response_code(200);
    echo json_encode(array('result'=>'success'));
}else{
    http_response_code(500);
    echo json_encode(array('result'=>'fail'));
}
}
// show error
catch(PDOException $exception){
    http_response_code(500); 
    error_log($exception->getMessage()); 
    echo json_encode(array('result' => $exception->getMessage())); 
}
}
?>
