<?php

$router->get('', 'AuthController@login@loggedIn');
$router->get('signup', 'AuthController@signup@loggedIn');
$router->post('register', 'AuthController@register@loggedIn');
$router->get('signout', 'AuthController@signout@notLoggedIn');
$router->post('check', 'AuthController@check@loggedIn');
$router->get('verify','AuthController@emailverification@');
$router->get('forgot_pass','AuthController@forgot_pass@');
$router->post('recover','AuthController@recover@');
$router->get('reset-password','AuthController@reset_password@');
$router->post('confirm-pass','AuthController@confirm_pass@');


$router->get('index','BlogController@index@notLoggedIn');
$router->get('about','BlogController@about@notLoggedIn');

$router->get('dashboard/index','DashboardController@index@notLoggedIn');
$router->post('dashboard/make-admin','DashboardController@make_admin@notLoggedIn');

$router->get('dashboard/tags','DashboardController@tags@notLoggedIn');
$router->post('dashboard/create-tag','TagController@create@notLoggedIn');


$router->get('dashboard/categories','DashboardController@categories@notLoggedIn');
$router->post('dashboard/create-category','CategoriesController@create@notLoggedIn');
$router->post('dashboard/edit-category','CategoriesController@edit@notLoggedIn');
$router->post('dashboard/delete-category','CategoriesController@delete@notLoggedIn');


$router->get('dashboard/articles','DashboardController@articles@notLoggedIn');
$router->post('dashboard/article/mark-article','ArticleController@markArticle@notLoggedIn');
$router->post('dashboard/article/un-mark-article','ArticleController@unMarkArticle@notLoggedIn');
$router->post('dashboard/article/publish-article','ArticleController@publishArticle@notLoggedIn');
$router->post('dashboard/article/draft-article','ArticleController@draftArticle@notLoggedIn');

$router->get('dashboard/comments','DashboardController@comments@notLoggedIn');