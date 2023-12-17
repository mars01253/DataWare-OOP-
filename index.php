<?php
require 'user.php';
require 'signup.php';
if(isset($_POST['fullname'])&&isset($_POST['email'])&&isset($_POST['password'])){

    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $user = new user($fullname,$email,$pass);
    $user->insert();
    $user->check();
}
