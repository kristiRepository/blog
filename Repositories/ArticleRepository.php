<?php 

class ArticleRepository{

    
   
    protected $article;


    public function __construct()
    {
        $this->article = new Article();
       
    }

    public function mark($postId){
        $this->article->mark($postId);
    }

    public function unMark($postId){
        $this->article->unMark($postId);
    }

    public function publish($article_id){
        $this->article->publish($article_id);
    }

    public function unPublish($article_id){
        $this->article->unpublish($article_id);
    }
}