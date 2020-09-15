<?php

require('database/Connection.php');
require('Mail.php');



class AuthController
{

    protected $conn;
    protected $query;
    protected $userRequest;
    protected $authRepository;

    public function __construct($request)
    {
        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
        $this->userRequest = new UserRequest($request);
        $this->authRepository=new AuthRepository();
    }


    public function login()
    {
       
       $message= $this->authRepository->login($this->userRequest->verify(),$this->userRequest->getInput('vkey'));


        require('views/auth/login.php');
    }


    public function signup()
    {

        require('views/auth/signup.php');
    }



    public function register()
    {
        

        if($this->authRepository->register($this->userRequest->getInput('username'),$this->userRequest->getInput('password'),$this->userRequest->getInput('email'))){
            return;
        };
        header("Location: /verify");
    }


    public function check()
    {


        if ($this->userRequest->validateCheck()) {
            return;
        }

        if($this->authRepository->check($this->userRequest->getInput('username'),$this->userRequest->getInput('password'))){
            return;
        }
        header("Location: /index");
    }


    public function signout()
    {
        $this->authRepository->signout();
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
        
        if($this->authRepository->recover($this->userRequest->getInput('recovery-email'))){
            return;
        }

        header("Location: /verify");
    }


    public function reset_password()
    {
        $vkey=$this->userRequest->validateUpdate();
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
        $this->authRepository->confirm_pass($this->userRequest->getInput('vkey'),$this->userRequest->getInput('password'));
        header('Location: /');
    }
}
