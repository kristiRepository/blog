<?php


class DashboardController
{


   
    protected $userRequest;
    protected $dashboardRepository;
   

    public function __construct($request)
    {

        
        $this->userRequest = new UserRequest($request);
        $this->dashboardRepository=new DashboardRepository();
    }

    public function index()
    {

        $users=$this->dashboardRepository->allVerified();
        require('views/blog/dashboard/index.php');
    }

    public function categories()
    {
        $categories = $this->dashboardRepository->getAllCategories();
        require('views/blog/dashboard/categories.php');
    }

    public function articles()
    {
        $result=$this->dashboardRepository->articles();
        $articles=$result['articles'];
        $article_tags=$result['article_tags'];
        require('views/blog/dashboard/articles.php');
    }

    public function comments()
    {
        $result=$this->dashboardRepository->comments();
        $comments = $result[0];

        require('views/blog/dashboard/comments.php');
    }

    public function tags()
    {
        
        $tags=$this->dashboardRepository->tags();
        require('views/blog/dashboard/tags.php');
    }

    public function make_admin()
    {
        $this->dashboardRepository->makeAdmin($this->userRequest->getInput('user_id'));
        header('Location: /dashboard/index');
    }
}
