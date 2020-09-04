<?php

class ArticleRequest extends Request implements ValidateInterface
{

  
    public function __construct($request)
    {
        $this->input = $request->input();
        
    }

    public function validateCreate(){
       
        return ;
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
       
        return ;
    }

    public function confirm(){
        return;
    }




}