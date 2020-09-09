<?php 

class Comment{

    protected $conn;
    protected $query;

    private $comment_body;
    private $id;
    private $user_id;
    private $article_id;

    public function __construct(){

        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
    }

    public function add($name){
        $this->query->insert('comment',['comment_body','article_id','user_id'],$name);
    }

    public function articleComments($article_title){
        return $this->query->articleComments($article_title);
    }









}