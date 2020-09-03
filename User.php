<?php 



class User{

    protected $conn;
    protected $query;

    private $id;
    private $username;
    private $email;
    private $password;
    private $vkey;
    private $verified;
    private $createdate;
    private $user_role;


    public function __construct()
    {
        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
    }

    public function getUsername(){
        return $this->username;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getVkey(){
        return $this->vkey;
    }
    public function getVerified(){
        return $this->verified;
    }
    public function getCreateDate(){
        return $this->createdate;
    }
    public function getUserRole(){
        return $this->user_role;
    }
    public function getId(){
        return $this->id;
    }


    public static function setCookie(array $data){
       
        
        if (!empty($_POST['remember'])) {
            setcookie('username', $data[0], time() + (10 * 365 * 24 * 60 * 60));
            setcookie('password', $data[1], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE['username'])) {
                setcookie('username', "");
            }
            if (isset($_COOKIE['password'])) {
                setcookie('password', "");
            }
        }

    }

    public function allVerified(){

        return $this->query->getAllVerifiedUsers();
        
    }

    public function makeAdmin($user_id){
          $this->query->update('user','user_role','admin','id',$user_id);
    }

   


    

}