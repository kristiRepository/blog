<?php


class Request
{

    protected $input;

    public function __construct($input)
    {

        $this->input = $input;
    }

    public static function uri()

    {

        return trim(str_replace(basename(getcwd()), "", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');
    }

    public static function method()
    {

        return $_SERVER['REQUEST_METHOD'];
    }

    public static function input(){
       $data =  array_merge($_POST, $_GET);
        return new self($data);
    }

    protected function test($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    
    }

    public function getInput($name){
        return $this->input()->input[$name] ?? null;
    }

    
}
