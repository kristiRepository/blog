<?php 

class AuthRepository{

    
    protected $conn;
    protected $query;
   

    public function __construct()
    {
        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
     
    }

    public function login($verification,$vkey){
        
        $message = "You need to verify your email address";
        if ($verification) {
            $result = $this->query->setVerified($vkey);
            if ($result) {
                $message = "Your email has been verified";
            }
        }
        return $message;
    }

    public function register($username,$password,$email){

        $result = $this->query->select('user', $username, 'username');
        if (!empty($result)) {
            session_start();
            $_SESSION['message'] = "Username exists";
            header("Location: /signup");
            return true;
        }
        $exist = $this->query->select('user', $email, 'email');
        if (!empty($exist)) {
            session_start();
            $_SESSION['message'] = "Email exists";
            header("Location: /signup");
            return true;
        }


        $vkey = md5(time() . $username);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $image=$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],"views/auth/profile_picture/".$_FILES['image']['name']);
        $this->query->insert('user', ['username', 'password', 'email', 'vkey','profile_picture'], [
            $username,
            $password,
            $email,
            $vkey,
            $image
        ]);


        Mail::sendEmail($email, $username, $vkey);
    }

    public function check($username,$password){

        $result = $this->query->select('user', $username, 'username');
        $user = "";

        if (empty($result)) {
            session_start();
            $_SESSION['message'] = "Incorrect username";
            header("Location: /");
            return true;
        } else {
            if (password_verify($password, $result[0]['password'])) {
                $user = $result;
            } else {
                session_start();
                $_SESSION['message'] = "Incorrect password";
                header("Location: /");
                return true;
            }
        }
        if ($user[0]['verified'] == '0') {
            session_start();
            $_SESSION['message'] = "User is not verified";
            header("Location: /");
            return true;
        }


        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['username'] = $user[0]['username'];
        $_SESSION['user_role'] = $user[0]['user_role'];
        $_SESSION['profile_picture']=$user[0]['profile_picture'];

        User::setCookie([$username, $password]);
    }

    public function signout(){

        session_start();
        unset($_SESSION['id']);
        header("Location: /");
    }

    public function recover($recovery_email){

        $exist = $this->query->select('user', $recovery_email, 'email');
        if (empty($exist)) {
            session_start();
            $_SESSION['e-message'] = "Email not registered";
            header("Location: /forgot_pass");
            return true;
        }

        $result = $this->query->select('user', $recovery_email, 'email');
        Mail::sendPassword($recovery_email, $result[0]['username'], $result[0]['vkey']);
    }

    public function confirm_pass($vkey,$password){

        $result=$vkey;
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->query->update('user', 'password', $password, 'vkey', $vkey);
       
        
    }





}