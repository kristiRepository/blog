<?php

class CategoryRequest extends Request implements ValidateInterface
{

  
    public function __construct($request)
    {
        $this->input = $request->input();
        
    }

    public function validateCreate(){
        if (is_null($this->getInput('name')) || $this->getInput('name')=="") {
            session_start();
            $_SESSION['message'] = "Category not created";
            header("Location: /dashboard/categories");
            return true;
        }
        return false;
    }
    
    public function validateCheck(){
        if (is_null($this->getInput('edit-name')) || $this->getInput('edit-name')=="" || is_null($this->getInput('category_id'))){
            session_start();
            $_SESSION['message'] = "Category not edited";
            header("Location: /dashboard/categories");
            return true;
        }
        return false;
    }

    public function verify(){
        return;
    }

    public function recover(){
        return;
    }

    public function validateUpdate(){
        if (is_null($this->getInput('delete_category')) ){
            session_start();
            $_SESSION['message'] = "Category not found";
            header("Location: /dashboard/categories");
            return true;
        }
        return false;
    }

    public function confirm(){
        return;
    }

}