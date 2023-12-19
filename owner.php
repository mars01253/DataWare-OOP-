<?php
    require 'user.php';
    require 'view/ownerview.php';


    if(isset($_POST['submit'])){
        $id=$_POST['idproject'];
        $name=$_POST['name'];
        $projectmanager=$_POST['managerid'];
        $projectdesc=$_POST['desc'];
        $deadline=$_POST['deadline'];
        $owner = new owner($id,$name,$projectmanager,$projectdesc, $deadline);
        $owner->modify();
    }elseif(isset($_POST['delete'])){
        $i=$_POST['index'];
        $id=$_POST['projectid'.$i];
        $owner = new owner($id);
        $owner->delete();
    }
       
   
   $logout = "";
    
    if(isset($_POST['logout'])){
        $logout=$_POST['logout'];
        $userlogout->checklog();
        $userlogout->logout($logout);
    }