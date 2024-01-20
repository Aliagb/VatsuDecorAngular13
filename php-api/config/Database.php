<?php

class Database {
// used to connect to the database
private $host = "localhost";
private $db_name = "Store3";
private $username = "root";
private $password = "";
private $con;

public function connect() {
    $this->con = null;

    try {
        $this->con = new PDO(
            "mysql:host=" . $this->host . 
            ";dbname=" . $this->db_name,
            $this->username,
            $this->password
        );
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Log success message
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return $this->con;
}
}
