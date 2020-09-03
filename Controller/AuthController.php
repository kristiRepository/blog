<?php

require('database/Connection.php');
require('Mail.php');



class AuthController
{

    protected $conn;
    protected $query;
    protected $userRequest;

    public function __construct($request)
    {
        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
        $this->userRequest = new UserRequest($request);
        
    }


    public function login()
    {
        $message="You need to verify your email address";
    if($this->userRequest->verify()){
   $vkey = $this->userRequest->getInput('vkey');
            $result = $this->query->setVerified($vkey);
            if ($result) {
               $message= "Your email has been verified";
            }
    }
    

        require('views/auth/login.php');
    }


    public function signup()
    {

        require('views/auth/signup.php');
    }



    public function register()
    {
        if ($this->userRequest->validateCreate()) {
            return;
        };
        $result = $this->query->select('user',$this->userRequest->getInput('username'), 'username');
            if (!empty($result)) {
                session_start();
                $_SESSION['message'] = "Username exists";
                header("Location: /signup");
                return;
            }
        $exist = $this->query->select('user',$this->userRequest->getInput('email'), 'email');
            if (!empty($exist)) {
                session_start();
                $_SESSION['message'] = "Email exists";
                header("Location: /signup");
                return ;
            }


        $vkey = md5(time() . $this->userRequest->getInput('username'));
        $password = password_hash($this->userRequest->getInput('password'), PASSWORD_DEFAULT);
        $this->query->insert('user',['username','password','email','vkey'],[$this->userRequest->getInput('username'),
            $password,
            $this->userRequest->getInput('email'),
            $vkey] );


        Mail::sendEmail($this->userRequest->getInput('email'),$this->userRequest->getInput('username'),$vkey);
        header("Location: /verify");
    }


    public function check()
    {

        
        if ($this->userRequest->validateCheck()) {
            return;
        }
        $result = $this->query->select('user',$this->userRequest->getInput('username'), 'username');
        $user="";

        if (empty($result)) {
            session_start();
            $_SESSION['message'] = "Incorrect username";
            header("Location: /");
            return;
        } else {
            if (password_verify($this->userRequest->getInput('password'), $result[0]['password'])) {
                $user = $result;
            } else {
                session_start();
                $_SESSION['message'] = "Incorrect password";
                header("Location: /");
                return;
            }
        }
        if ($user[0]['verified'] == '0') {
            session_start();
            $_SESSION['message'] = "User is not verified";
            header("Location: /");
            return;
        } 


        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['username'] = $user[0]['username'];

        User::setCookie([$this->userRequest->getInput('username'), $this->userRequest->getInput('password')]);
        header("Location: /index");
    }


    public function signout()
    {
        session_start();
        unset($_SESSION['id']);
        header("Location: /");
    }

    public function emailverification()
    {

        require('views/auth/verify.php');
    }

    public function forgot_pass()
    {

        require('views/auth/forgot_pass.php');
    }

    public function recover()
    {

        if ($this->userRequest->recover() == null) {
            return;
        }
        $exist = $this->query->select('user',$this->userRequest->getInput('recovery-email'), 'email');
        if (empty($exist)) {
            session_start();
            $_SESSION['e-message'] = "Email not registered";
            header("Location: /forgot_pass");
            return;
        }

        $result = $this->query->select('user',$this->userRequest->getInput('recovery-email'), 'email');
        Mail::sendPassword($this->userRequest->getInput('recovery-email'), $result[0]['username'], $result[0]['vkey']);

        header("Location: /verify");
    }


    public function reset_password()
    {
        $vkey = $this->userRequest->validateUpdate();
        if ($vkey == null) {
            return;
        }

        require('views/auth/recover-pass.php');
    }

    public function confirm_pass()
    {
        if ($this->userRequest->confirm()) {
            return;
        }

        $vkey = $this->userRequest->getInput('vkey');
        $password = password_hash($this->userRequest->getInput('password'), PASSWORD_DEFAULT);

        $this->query->update('user','password',$password,'vkey',$vkey);
        header('Location: /');
    }

    
}
