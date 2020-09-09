<?php


class DashboardController
{

    
    protected $user;
    protected $category;
    protected $userRequest;
    protected $tag;
    protected $article;

    public function __construct($request)
    {

        $this->user = new User();
        $this->category = new Category();
        $this->tag = new Tag();
        $this->article=new Article();
        $this->userRequest = new UserRequest($request);
        
    }

    public function index(){
        
        
        $users=$this->user->allVerified();
        require('views/blog/dashboard/index.php');
    }

    public function categories(){
        $categories=$this->category->getAllCategories();
        require('views/blog/dashboard/categories.php');
    }

    public function articles(){
        $result=$this->article->getAllArticles(0,6);
        $articles=$result[0];
        $article_tags=$this->article->getArticlesWithTags();
        require('views/blog/dashboard/articles.php');
    }

    public function comments(){
        require('views/blog/dashboard/comments.php');
    }

    public function tags(){
        $tags=$this->tag->getAllTags();
        require('views/blog/dashboard/tags.php');
    }

    public function make_admin(){
        $this->user->makeAdmin($this->userRequest->getInput('user_id'));
        header('Location: /dashboard/index');
    }


}