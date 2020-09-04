<?php




class BlogController
{
    protected $article;
    

    public function __construct()
    {

        $this->article=new Article();
        
    }

    public function index(){

        $articles=$this->article->getAllArticlesBlog();
        $article_tags=$this->article->getTagsBlog();
        require('views/blog/blog.php');
    }

   




}