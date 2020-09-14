<?php

class ArticleRequest extends Request implements ValidateInterface
{


    public function __construct($request)
    {
        $this->input = $request->input();
    }

    protected function helper($attribute)
    {
        if (is_null($this->getInput($attribute)) || $this->getInput($attribute) == "") {
            session_start();
            $_SESSION['message'] = ucfirst($attribute) . " not set";
            header("Location: /blog/create");
            return true;
        }
    }

    public function validateCreate()
    {
        if ($this->helper('title')) {
            return true;
        }
        if ($this->helper('summary')) {
            return true;
        }
        if ($this->helper('body')) {
            return true;
        }
        if (!isset($_FILES['image']['name']) || $_FILES['image']['name'] == "" || $_FILES['image']['type'] != 'image/jpeg') {
            session_start();
            $_SESSION['message'] = "Image should be of type .jpeg";
            header("Location: /blog/create");
            return true;
        }
        if ($this->helper('category')) {
            return true;
        }
        if ($this->helper('tags')) {
            return true;
        }
        return false;
    }

    public function validateCheck()
    {
        if ($this->helper('title')) {
            return true;
        }
        if ($this->helper('summary')) {
            return true;
        }
        if ($this->helper('body')) {
            return true;
        }

        return false;
    }

    public function verify()
    {
        return;
    }

    public function recover()
    {
        return;
    }

    public function validateUpdate()
    {

        return;
    }

    public function confirm()
    {
        return;
    }
}
