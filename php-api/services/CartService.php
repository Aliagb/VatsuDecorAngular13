<?php

require_once '../config/Database.php';  
require_once '../models/Cart.php'; 

class CartService {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();

    }

    public function addToCart($selectedProductId) {
        
        $customerId = 1; 
        $productId = $selectedProductId; 
        $quantity = 1;

        try {
            $query = "INSERT INTO cart_item (customer_id, product_id, quantity) VALUES (:customer_id, :product_id, :quantity)";
            $stmt = $this->db->prepare($query);

            // Bind parameters
            $stmt->bindParam(':customer_id', $customerId);
            $stmt->bindParam(':product_id', $selectedProductId);
            $stmt->bindParam(':quantity', $quantity);

            $stmt->execute();

            // Log message
            $this->logActivity("Added product $productId to cart for customer $customerId");

            return ["message" => "Random product added to cart"];
        } catch (PDOException $e) {
            
            $this->logActivity("Failed to add random product to cart: " . $e->getMessage());
            return ["message" => "Failed to add random product to cart"];
        }
    }

    private function logActivity($message) {
        $logMessage = "[" . date('Y-m-d H:i:s') . "] " . $message . "\n";
        file_put_contents('../logs/cart.log', $logMessage, FILE_APPEND);
    }
}



?>