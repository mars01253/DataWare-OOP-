<?php 
require 'user.php';

require 'memdashview.php';
$logout = "";
if(isset($_POST['logout'])){
    $logout=$_POST['logout'];
    $userlogout->checklog();
    $userlogout->logout($logout);
}