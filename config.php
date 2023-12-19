<?php
require 'user.php';

$id = 0;
$conn = new Connection();
$pdo = $conn->pdo;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if(isset($_GET['type'])){
    $type = $_GET['type'];
}if($type==='assign'){
    $sql = 'UPDATE users SET user_role="Product Owner" WHERE user_id=?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);  
}elseif($type==='Reassign'){
    $sql = 'UPDATE users SET user_role="membre" WHERE user_id=?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);  
}elseif($type==='addpro'){
    $conn = new connection();
    $pdo = $conn->pdo;
    $title = $_GET['title'];
    $desc= $_GET['desc'];
    $deadline=$_GET['deadline'];
    $sql = 'INSERT INTO projects(project_name,project_deadline,product_owner,project_desc) Values(?,?,?,?)';
    $stmt = $pdo->prepare($sql);
    $input = $stmt->execute([$title, $deadline ,$id, $desc]);
}
elseif($type==='select'){
    $conn = new Connection();
    $pdo = $conn->pdo;
    $sql = 'SELECT * FROM users WHERE user_role <> "admin"';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); 
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $name = $result['user_fullname'];
        $id = $result['user_id'];
        echo "<option class='placeholder:font-light placeholder:text-xs focus:outline-none' value='$id'>$name</option>";
    }
}
?>
