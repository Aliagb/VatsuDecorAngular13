<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include '../config/Database.php';
$database = new Database();
$con = $database->connect();

if (!$con) {
    http_response_code(500); 
    echo json_encode(["message" => "Failed to connect to the database"]);
    exit;
}

if ($_POST) {
    try {
        $query = "UPDATE products 
                  SET name=:name, description=:description, qty=:qty, price=:price 
                  WHERE product_id = :id";

        $stmt = $con->prepare($query);

        // posted values
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];

        // Bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            http_response_code(200); 
            echo json_encode(array('result' => 'success'));
        } else {
            http_response_code(400); 
            echo json_encode(array('result' => 'fail'));
        }
    } catch (PDOException $exception) {
        http_response_code(500); 
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
