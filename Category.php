<?php 

class Category{

    protected $conn;
    protected $query;

    private $category_name;
    private $id;

    public function __construct(){

        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
    }

    public function getName(){
        return $this->category_name;
    }
    public function getid(){
        return $this->id;
    }

    public function getAllCategories(){
        return $this->query->all('category');
    }

    public function add($name){
     $this->query->insert('category',['category_name'],[$name]);
    }

    public function articlesCount(){
       return $this->query->count('article','category_id',$this->getid());
    }

    public function edit($name,$category_id){
      $this->query->update('category','category_name',$name,'id',$category_id);
    }

    public function delete($delete_category){
         $this->query->delete('category','id',$delete_category);
    }

   
}