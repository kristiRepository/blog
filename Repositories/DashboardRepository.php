<?php

class DashboardRepository
{

    protected $user;
    protected $category;
    protected $tag;
    protected $comment;
    protected $article;


    public function __construct()
    {
        $this->comment = new Comment();
        $this->user = new User();
        $this->category = new Category();
        $this->tag = new Tag();
        $this->article = new Article();
       
    }

    public function allVerified(){
        return $this->user->allVerified();
    }

    public function getAllCategories (){
        return $this->category->getAllCategories();
    }

    public function articles(){
        $result = $this->article->getAllArticles(0, 6);
        $articles = $result[0];
        $article_tags = $this->article->getArticlesWithTags();

        return ['articles'=>$articles,'article_tags'=>$article_tags];
    }

    public function comments(){
        return $this->comment->getAllComments();
    }

    public function tags(){
        return $this->tag->getAllTags();
    }

    public function makeAdmin($user_id){
        $this->user->makeAdmin($user_id);
    }



}