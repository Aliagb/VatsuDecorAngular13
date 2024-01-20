<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../config/Database.php';

// Handle preflight request for OPTIONS method
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Return OK status for preflight requests
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

// insert query
$query = "INSERT INTO products SET name=:name, description=:description, qty=:qty , price=:price";
// prepare query for execution
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

// Execute the query
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
    http_response_code(500); // Internal Server Error
    error_log($exception->getMessage()); // Log error to server log
    echo json_encode(array('result' => $exception->getMessage())); // For debugging purposes
}
}
?>
