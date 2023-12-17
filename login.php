<?php
require 'user.php';
require 'loginpage.php';
if(isset($_POST['email'])&&isset($_POST['password'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['password'];
    $userlog = new userlog($email,$pass);
    $userlog->login();
}
