<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// passed parameter value, recordId
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
include '../config/Database.php';
 
// read current record's data
try {
    $query = "SELECT p_id, p_name, p_description, p_price FROM products WHERE p_id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    $stmt->bindParam(1, $id);
 
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $json = json_encode($row);
    echo $json;
}
 
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
