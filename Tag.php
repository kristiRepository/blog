<?php 

class Tag{

    protected $conn;
    protected $query;

    private $tag_name;
    private $id;

    public function __construct(){

        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
    }

    public function getAllTags(){
        return $this->query->all('tag');
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->tag_name;
    }

    public function noArticles(){
        return $this->query->count('article_tag','tag_id',$this->getid());
    }

    public function createTag($name){
        $this->query->insert('tag',['tag_name'],[$name]);
    }



}