<?php 
require 'user.php';
$user = new user();
$user->checklog();
require 'memdashview.php';
$logout = "";
if(isset($_POST['logout'])){
    $logout=$_POST['logout'];
    $user->logout($logout);
}