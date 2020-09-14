<?php

class CommentRequest extends Request implements ValidateInterface
{

  
    public function __construct($request)
    {
        $this->input = $request->input();
        
    }

    public function validateCreate(){
        if (is_null($this->getInput('comment')) || $this->getInput('comment')=="") {
            session_start();
            $_SESSION['message'] = "Comment not added";
            header("Location: /blog/article/?article=".$this->getInput('slug'));
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
