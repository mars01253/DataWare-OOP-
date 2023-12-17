<?php
session_start();
include 'connection.php';
class user
{
    private $fullname;
    private $pass;
    private $email;
    private $img;
    public function __construct($fullname, $email, $pass, $img = "")
    {
        $this->fullname = filter_var($fullname, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->pass = password_hash($pass, PASSWORD_BCRYPT);
        $this->img = $img;
    }
    function insert()
    {
        $conn = new connection();
        $pdo = $conn->pdo;
        $sql = 'INSERT INTO users(user_fullname,user_email,user_pass) values(?,?,?)';
        $stmt = $pdo->prepare($sql);
        $input = $stmt->execute([$this->fullname, $this->email, $this->pass]);
    }
    function check()
    {
        $name = $this->fullname;
        $email = $this->email;
        $validmail = '/^[a-zA-Z]{3,}\s[a-zA-Z]{3,}$/';
        $validname = '/^(([a-zA-Z]{1,})\d{1,}@[a-z]{1,}\.[a-z]{1,3}|[a-z]+@[a-z]+\.[a-z]{1,3})$/';
        if (preg_match($validname, $name) && preg_match($validmail, $email)) {
            header('location:login.php');
        }
    }

    function uploadimg()
    {
        $conn = new connection();
        $pdo = $conn->pdo;
        $sql = 'INSERT INTO users(user_img) values(?)';
        $stmt = $pdo->prepare($sql);
        $input = $stmt->execute([$this->img]);
    }
}
class UserLog
{

    private $pass;
    private $email;
    public function __construct($email, $pass)
    {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->pass = $pass;
    }
    function login()
    {
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'SELECT * FROM users WHERE user_email=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $storedPasswordHash = $result['user_pass'];
            if (password_verify($this->pass, $storedPasswordHash)) {
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['fullname'] = $result['user_fullname'];
                $_SESSION['user_email'] = $result['user_email'];
                $userrole = $result['user_role'];
                switch ($userrole) {
                    case 'membre':
                        header('location:memdash.php');
                        $_SESSION['role'] = $userrole;
                        break;
                    case 'admin':
                        header('location:admdash.php');
                        $_SESSION['role'] = $userrole;
                        break;
                    case 'scrum':
                        header('location:scrum.php');
                        $_SESSION['role'] = $userrole;
                        break;
                    case 'owner':
                        header('location:owner.php');
                        $_SESSION['role'] = $userrole;
                        break;
                }
            }
        }
    }
}
class userlogout
{
    function checklog()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location:login.php');
            exit();
        }
    }
    function displayadm()
    {
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'SELECT * FROM users WHERE user_role <> "admin"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
            echo '<div class="mb-16">
                <dh-component>
                    <div class="container flex justify-center mx-auto pt-16">
                        <div>
                            <p class="text-gray-500 text-lg text-center font-normal pb-3">DATAWRE MEMBERS</p>
                            <h1 class="xl:text-4xl text-3xl text-center text-gray-800 font-extrabold pb-6 sm:w-4/6 w-5/6 mx-auto">The Talented People Behind the Scenes of the Organization</h1>
                        </div>
                    </div>
                
                        <section class = "flex flex-row flex-wrap justify-between items-center mt-10">';
                        $i=0;
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $name = $result['user_fullname'];   
                $img = $result['user_img'];
                $id = $result['user_id'];
                $email = $result['user_email'];
                $role = $result['user_role'];
                $status = $result['user_status'];
                echo "
                <div role='listitem' class='xl:w-1/3 sm:w-3/4 md:w-2/5 relative mt-16 mb-32 sm:mb-24 xl:max-w-sm lg:w-2/5'>
                    <div class='rounded overflow-hidden shadow-md bg-white'>
                        <div class='absolute -mt-20 w-full flex justify-center'>
                            <div class='h-32 w-32'>
                                <img src='$img'  class='rounded-full object-cover h-full w-full shadow-md' />
                            </div>
                        </div>";
                echo "<div class='px-6 mt-16'>
                            <h1 class='font-bold text-3xl text-center mb-1'>$name</h1>
                            <p class='text-gray-800 text-sm text-center'>$role</p>
                            <p class='text-gray-800 text-sm text-center'>$status</p>
                            <input value='$id' class='hidden' id='owner$i'>
                            <div class='w-full flex justify-center pt-5 pb-5'>
                              <button class='bg-blue-400 p-2 rounded-xl assignbtn'>Assign as Product Owner</button>
                            </div>
                        </div>
                    </div>
                
            </div>";
            $i++;
            }
            echo ' </section>   
            </div>
                </div>
                
             ';
        }
        function logout($logout)
        {
            if ($logout) {
                session_start();
                session_unset();
                session_destroy();
                header('location:login.php');
            }
        }
    }

$userlogout = new userlogout;
