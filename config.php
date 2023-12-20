<?php
require 'user.php';

$id = 0;
$conn = new Connection();
$pdo = $conn->pdo;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}



switch ($type) {
    case 'assign':
        $sql = 'UPDATE users SET user_role="Product Owner" WHERE user_id=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        break;
    case 'Reassign':
        $sql = 'UPDATE users SET user_role="membre" WHERE user_id=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        break;
    case 'addpro':
        $conn = new connection();
        $pdo = $conn->pdo;
        $title = $_GET['title'];
        $desc = $_GET['desc'];
        $deadline = $_GET['deadline'];
        $sql = 'INSERT INTO projects(project_name,project_deadline,product_owner,project_desc) Values(?,?,?,?)';
        $stmt = $pdo->prepare($sql);
        $input = $stmt->execute([$title, $deadline, $id, $desc]);
        break;
    case 'select':
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
        break;
    case 'selectteam':
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'SELECT * FROM projects';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $name = $result['project_name'];
            $id = $result['project_id'];
            echo "<option class='placeholder:font-light placeholder:text-xs focus:outline-none' value='$id'>$name</option>";
        }
        break;
}
