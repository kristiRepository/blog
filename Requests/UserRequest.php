<?php

class UserRequest extends Request implements ValidateInterface
{


    public function __construct($request)
    {
        $this->input = $request->input();
    }


    public function validateCreate()
    {


        if (is_null($this->getInput('username'))) {
            session_start();
            $_SESSION['message'] = "Username not set";
            header("Location: /signup");
            return true;
        }
        if ($this->getInput('email')) {
            $email = $this->test($this->getInput('email'));
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                session_start();
                $_SESSION['message'] = "Invalid email";
                header("Location: /signup");
                return true;
            }
        } else {
            session_start();
            $_SESSION['message'] = "Email not set";
            header("Location: /signup");
            return true;
        }


        if ($this->getInput('password')) {
            if (strlen($_POST['password']) < 6) {
                session_start();
                $_SESSION['message'] = "Password is too short";
                header("Location: /signup");
                return true;
            }
            if ($this->getInput('password') != $this->getInput('confirm-password')) {
                session_start();
                $_SESSION['message'] = "Passwords don't match";
                header("Location: /signup");
                return true;
            }
        } else {
            session_start();
            $_SESSION['message'] = "Password not set";
            header("Location: /signup");
            return true;
        }
        if (! isset($_FILES['image']['name']) || $_FILES['image']['name'] == "" ) {
            session_start();
            $_SESSION['message'] = "Image not set";
            header("Location: /signup");
            return true;
        }
        return false;
    }


    public function validateCheck()
    {

        if (is_null($this->getInput('username'))) {

            session_start();
            $_SESSION['message'] = "Username not set";
            header("Location: /");
            return true;
        }
        if (is_null($this->getInput('password'))) {

            session_start();
            $_SESSION['message'] = "Password not set";
            header("Location: /");
            return true;
        }
        return false;
    }

    public function verify()
    {


        if (is_null($this->getInput('vkey'))) {

            return false;
        }
        return true;
    }

    public function recover()
    {
        if ($this->getInput('recovery-email')) {
            $email = $this->test($this->getInput('recovery-email'));
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                session_start();
                $_SESSION['e-message'] = "Invalid email";
                header("Location: /forgot_pass");
                return;
            }
        } else {
            session_start();
            $_SESSION['e-message'] = "Email not set";
            header("Location: /forgot_pass");
            return;
        }

        return $email;
    }

    public function validateUpdate()
    {

        $vkey = "";
        if ($this->getInput('vkey')) {
            $vkey = $this->getInput('vkey');
            return $vkey;
        } else {
            header('Location: /');
            return;
        }
    }

    public function confirm()
    {
        $vkey = "";
        if ($this->getInput('vkey')) {
            $vkey = $this->getInput('vkey');
        } else {
            header('Location: /');
            return true;
        }
        if ($this->getInput('password')) {
            if (strlen($this->getInput('password')) < 6) {
                session_start();
                $_SESSION['e-message'] = "Password is too short";
                header("Location: /reset-password/?vkey={$vkey}");
                return true;
            }
            if ($this->getInput('password') != $this->getInput('confirm-password')) {
                session_start();
                $_SESSION['e-message'] = "Passwords don't match";
                header("Location: /reset-password/?vkey={$vkey}");
                return true;
            }
        } else {
            session_start();
            $_SESSION['e-message'] = "Password not set";
            header("Location: /reset-password/?vkey={$vkey}");
            return true;
        }

        return false;
    }
}
