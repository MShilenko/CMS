<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();

require_once 'bootstrap.php';

$router = new \App\Core\Router();

$router->get('/', \App\Controller\PageController::class . '@index');
$router->get('/about', \App\Controller\PageController::class . '@about');

$router->get('/articles/*', \App\Controller\ArticleController::class . '@article');

$router->get('/admin', \App\Controller\AdminController::class . '@index');
$router->get('/admin/articles', \App\Controller\AdminController::class . '@allArticles');
$router->get('/admin/articles/*', \App\Core\Controller::class . '@article');

$router->get('/registration', \App\Controller\AuthController::class . '@registration');
$router->get('/authorization', \App\Controller\AuthController::class . '@authorization');



$router->post('/registration', \App\Controller\UserController::class . '@add');
$router->post('/authorization', \App\Controller\UserController::class . '@auth');

$application = new \App\Core\Application($router);

$application->run();
