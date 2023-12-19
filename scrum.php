<?php
require 'user.php';
require 'view/scrumview.php';
$id = 0;
$name = "";
$projectmanager = 0;
if (isset($_POST['submit'])) {
    $id = $_SESSION['user_id'];
    $name = $_POST['title'];
    $projectmanager = $_POST['project'];
    $scrum = new scrum($id, $name, $projectmanager);
    $scrum->add();
}
