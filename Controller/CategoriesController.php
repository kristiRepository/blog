<?php


class CategoriesController
{

    protected $categoryRequest;
    protected $categoryRepository;
    



    public function __construct($request)
    {
        $this->categoryRepository = new CategoryRepository();
        $this->categoryRequest = new CategoryRequest($request);
    }


    public function create()
    {

        if ($this->categoryRequest->validateCreate()) {
            return;
        };

        $this->categoryRepository->add($this->categoryRequest->getInput('name'));  
        header('Location: /dashboard/categories');
    }

    public function edit()
    {

        if ($this->categoryRequest->validateCheck()) {
            return;
        };
        $this->categoryRepository->edit($this->categoryRequest->getInput('edit-name'),$this->categoryRequest->getInput('category_id'));
        header('Location: /dashboard/categories');
    }

    public function delete()
    {
        if ($this->categoryRequest->validateUpdate()) {
            return;
        };
        $this->categoryRepository->delete($this->categoryRequest->getInput('delete_category'));
        header('Location: /dashboard/categories');
    }
}
