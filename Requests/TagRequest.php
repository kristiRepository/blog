<?php

class TagRequest extends Request implements ValidateInterface
{

  
    public function __construct($request)
    {
        $this->input = $request->input();
        
    }

    public function validateCreate(){
        if (is_null($this->getInput('name')) || $this->getInput('name')=="") {
            session_start();
            $_SESSION['message'] = "Tag not created";
            header("Location: /dashboard/tags");
            return true;
        }
        return false;
    }
    
    public function validateCheck(){
       
        return ;
    }

    public function verify(){
        return;
    }

    public function recover(){
        return;
    }

    public function validateUpdate(){
        
        return;
    }

    public function confirm(){
        return;
    }

}