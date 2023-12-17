<?php
include '...modal/connection.php';
class user {
    public $name="mouad";
    public $age=22 ;
    public function __construct($name , $age)
    {
            // return $this->name."hello im ". $this->age;
            echo "hello". $this->name=$name ."and" .$this->age=$age;
        
    }
}
$user = new user('mouad',22);
$connection = new Connection();
