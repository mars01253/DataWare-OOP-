<?php

class Connection {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "dataware";
    private $dsn;
    private $pdo; 

    public function __construct() {
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;

        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
            // Set PDO attributes or perform any other setup if needed
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
$connection = new Connection();
