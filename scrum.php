<?php
require 'user.php';
require 'view/scrumview.php';
$id = $_SESSION['user_id'];
$name = "";
$projectmanager = 0;
if (isset($_POST['submit'])) {
    $name = $_POST['title'];
    $projectmanager = $_POST['project'];
    $scrum = new scrum($id, $name, $projectmanager);
    $scrum->add();
}elseif(isset($_POST['editsubmit'])){
    $name=$_POST['name'];
    $teamid=$_POST['id'];
    $proid = $_POST['projectid'];
    $scrum = new scrum($name,$proid,  $teamid);
    $scrum->modify($name,$proid,$teamid);
    header('location:'. $_SERVER['HTTP_REFERER']);
        exit;

}if(isset($_POST['delete'])){
    $i=$_POST['index'];
    $teamid=$_POST['teamid'.$i];
    $scrum = new scrum($teamid);
    $scrum->delete($teamid);

}
$logout = "";
    
    if(isset($_POST['logout'])){
        $logout=$_POST['logout'];
        $userlogout->checklog();
        $userlogout->logout($logout);
    }
