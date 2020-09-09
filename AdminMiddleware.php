<?php



class AdminMiddleware
{

    public function __construct()
    {
        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new AllQuery($this->conn);
    }

    public function isAdmin()
    {
       
        
        if ($_SESSION['user_role'] != 'admin') {
            header("Location: /index");
            return true;
        } else {
            return false;
        }
    }
}
