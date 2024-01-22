<?php
class Product {

    private $conn;
    private $table_name = "products";

    public $product_id;
    public $name;
    public $qty;
    public $description;
    public $price;

    // Constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to read single product by ID
    public function getProductById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->product_id);

        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->name = $row['name'];
        $this->qty = $row['qty'];
        $this->description = $row['description'];
        $this->price = $row['price'];
    }


}
?>
