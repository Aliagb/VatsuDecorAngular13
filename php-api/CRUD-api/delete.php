<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS"); // Include DELETE here
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include '../config/Database.php';

$database = new Database();
$con = $database->connect();

if (!isset($con)) {
    http_response_code(500);
    echo json_encode(["message" => "Failed to establish database connection."]);
    exit; 
}
 
try {
     
    // get record ID
    // verify if a value is there or not
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    $query = "DELETE FROM products WHERE product_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
     
    if($stmt->execute()){
       echo json_encode(array('result'=>'success'));
    }else{
        echo json_encode(array('result'=>'fail'));
    }
}
 
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
