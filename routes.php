<?php

$router->get('', 'AuthController@login@loggedIn@');
$router->get('signup', 'AuthController@signup@loggedIn@');
$router->post('register', 'AuthController@register@loggedIn@');
$router->get('signout', 'AuthController@signout@notLoggedIn@');
$router->post('check', 'AuthController@check@loggedIn@');
$router->get('verify','AuthController@emailverification@@');
$router->get('forgot_pass','AuthController@forgot_pass@@');
$router->post('recover','AuthController@recover@@');
$router->get('reset-password','AuthController@reset_password@@');
$router->post('confirm-pass','AuthController@confirm_pass@@');


$router->get('index','BlogController@index@notLoggedIn@');


$router->get('blog/create','BlogController@create@notLoggedIn@');
$router->post('blog/store','BlogController@store@notLoggedIn@');
$router->get('blog/edit','BlogController@edit@notLoggedIn@');
$router->get('blog/article','BlogController@show@notLoggedIn@');
$router->post('blog/delete','BlogController@delete@notLoggedIn@');


$router->get('dashboard/index','DashboardController@index@notLoggedIn@isAdmin');
$router->post('dashboard/make-admin','DashboardController@make_admin@notLoggedIn@isAdmin');

$router->get('dashboard/tags','DashboardController@tags@notLoggedIn@isAdmin');
$router->post('dashboard/create-tag','TagController@create@notLoggedIn@isAdmin');


$router->get('dashboard/categories','DashboardController@categories@notLoggedIn@isAdmin');
$router->post('dashboard/create-category','CategoriesController@create@notLoggedIn@isAdmin');
$router->post('dashboard/edit-category','CategoriesController@edit@notLoggedIn@isAdmin');
$router->post('dashboard/delete-category','CategoriesController@delete@notLoggedIn@isAdmin');


$router->get('dashboard/articles','DashboardController@articles@notLoggedIn@isAdmin');
$router->post('dashboard/article/mark-article','ArticleController@markArticle@notLoggedIn@isAdmin');
$router->post('dashboard/article/un-mark-article','ArticleController@unMarkArticle@notLoggedIn@isAdmin');
$router->post('dashboard/article/publish-article','ArticleController@publishArticle@notLoggedIn@isAdmin');
$router->post('dashboard/article/unpublish-article','ArticleController@unpublishArticle@notLoggedIn@isAdmin');

$router->get('dashboard/comments','DashboardController@comments@notLoggedIn@isAdmin');
$router->post('add-comment','CommentController@add@notLoggedIn@');