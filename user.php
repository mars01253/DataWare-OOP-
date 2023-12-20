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
class owner extends user
{
    private $id;
    private $name;
    private $projectmanager;
    private $projectdesc;
    private $deadline;
    public function __construct($id, $name = '', $projectmanager = '', $projectdesc = '', $deadline = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->projectmanager = $projectmanager;
        $this->projectdesc = $projectdesc;
        $this->deadline = $deadline;
    }
    function modify()
    {
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'UPDATE projects 
        SET project_name = ?, project_deadline = ?, project_desc = ? , project_manager = ?
        WHERE project_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->name, $this->deadline,  $this->projectdesc, $this->projectmanager, $this->id]);
    }
    function delete()
    {
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'DELETE FROM projects WHERE project_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
    }
}
class scrum extends user
{
    private $id;
    private $name;
    private $projectmanager;
    private $projectdesc;
    private $deadline;
    public function __construct($id = 0, $name = '', $projectmanager = '', $projectdesc = '', $deadline = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->projectmanager = $projectmanager;
        $this->projectdesc = $projectdesc;
        $this->deadline = $deadline;
    }
    function add()
    {
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'INSERT into teams(team_name , team_status, scrum_id ,pro_id) Values(?,?,?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->name, 'active', $this->id, $this->projectmanager]);
    }
    function modify($name , $proid, $id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->projectmanager = $proid;
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'UPDATE teams 
        SET team_name = ?, pro_id = ?
        WHERE team_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->name, $this->projectmanager,  $this->id]);
        
    }
    function delete($teamid)
    {
        $this->id=$teamid;
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'DELETE FROM teams WHERE team_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
    }
    function display($scrumid)
    {
        $this->id = $scrumid;
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'SELECT * FROM teams WHERE scrum_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function displaymembers()
    {
        
        $conn = new Connection();
        $pdo = $conn->pdo;
        $sql = 'SELECT * FROM users';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
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
                    case 'Product Owner':
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
        $i = 0;
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
            header('location: login.php');
        }
    }
    function displaypro($ownerid)
    {
    }
}

$userlogout = new userlogout;
