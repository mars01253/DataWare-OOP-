<?php

class Connection {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "dataware";
    private $dsn;
    public $pdo; 

    public function __construct() {
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;

        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
$connection = new Connection();