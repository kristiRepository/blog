<?php




class BlogController
{

    protected $conn;
    protected $query;

    public function __construct()
    {

        $config = require('config.php');
        $this->conn = Connection::create($config);
        
    }

    public function index(){

        
        require('views/blog/blog.php');
    }

    public function about(){

        
        require('views/blog/about.php');
    }




}