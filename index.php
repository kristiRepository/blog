<?php




require_once 'vendor/autoload.php';


Router::load('routes.php')
    ->direct(Request::uri(), Request::method(), Request::input());

  