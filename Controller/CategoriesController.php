<?php


class CategoriesController
{

    protected $categoryRequest;
    protected $category;
  

    public function __construct($request)
    {
        $this->category = new Category();
        $this->categoryRequest = new CategoryRequest($request);
    }


    public function create(){

        if ($this->categoryRequest->validateCreate()) {
            return;
        };

        $this->category->add($this->categoryRequest->getInput('name'));
        header('Location: /dashboard/categories');
    }

    public function edit(){

        if ($this->categoryRequest->validateCheck()) {
            return;
        };

        $this->category->edit($this->categoryRequest->getInput('edit-name'),$this->categoryRequest->getInput('category_id'));
        session_start();
        $_SESSION['success']="Category edited successfully";
        header('Location: /dashboard/categories');
    }

    public function delete(){
        if ($this->categoryRequest->validateUpdate()) {
            return;
        };
        $this->category->delete($this->categoryRequest->getInput('delete_category'));
        session_start();
        $_SESSION['success']="Category deleted successfully";
        header('Location: /dashboard/categories');


    }
}