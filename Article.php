<?php 

class Article{

    protected $conn;
    protected $query;

    
    private $id;
    private $title;
    private $slug;
    private $summary;
    private $body;
    private $image;
    private $category_id;
    private $publish_date;
    private $status;
    private $is_feature;
    private $meta_data;
    private $user_id;


    public function __construct(){

        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
    }

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getSlug(){
        return $this->slug;
    }
    public function getSummary(){
        return $this->summary;
    }
    public function getBody(){
        return $this->body;
    }
    public function getImage(){
        return $this->image;
    }
    public function getCategoryId(){
        return $this->category_id;
    }
    public function getPublishDate(){
        return $this->publish_date;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getIsFeature(){
        return $this->is_feature;
    }
    public function getMetaData(){
        return $this->meta_data;
    }
    public function getUserId(){
        return $this->user_id;
    }

    public function getAllArticles(){
        return $this->query->allArticlesWithUsersWithCategories('article');
    }

    public function mark($postId){
        $this->query->update('article','is_feature','1','id',$postId);
    }
    public function unMark($postId){
        $this->query->update('article','is_feature','0','id',$postId);
    }

    public function publish($articleId){
        $this->query->update('article','status','published','id',$articleId);
    }

    public function draft($articleId){
        $this->query->update('article','status','draft','id',$articleId);
    }

    public function getArticlesWithTags(){
        return $this->query->getArticlesWithTags();
    }

    public function getAllArticlesBlog(){
        return $this->query->getArticlesAll();
      
    }

    public function getTagsBlog(){
        return $this->query->getTagsWithArticles();
    }





}