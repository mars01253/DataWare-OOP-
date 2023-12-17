<?php
require 'user.php';

$id = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$conn = new Connection();
$pdo = $conn->pdo;

$sql = 'UPDATE users SET user_role="Product Owner" WHERE user_id=?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);  
?>
