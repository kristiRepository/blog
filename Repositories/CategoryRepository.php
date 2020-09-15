<?php

class CategoryRepository
{


   
    protected $category;


    public function __construct()
    {
        $this->category = new Category();
       
    }

    public function add($name){
        
        $this->category->add($name);
    }

    public function edit($edit_name,$category_id){

        $this->category->edit($edit_name, $category_id);
        session_start();
        $_SESSION['success'] = "Category edited successfully";
    }

    public function delete($delete_category){

        $this->category->delete($delete_category);
        session_start();
        $_SESSION['success'] = "Category deleted successfully";
    }

}