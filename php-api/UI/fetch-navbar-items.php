<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include '../config/Database.php';

// Create a new instance of Database and get the connection
$database = new Database();
$conn = $database->connect();

$sql = "SELECT * FROM navbar_table"; 
$result = $conn->query($sql);

$navbarItems = array();

if ($result->rowCount() > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($navbarItems, $row);
    }
    echo json_encode($navbarItems);
} else {
    echo json_encode(array("message" => "No items found"));
}
?>
