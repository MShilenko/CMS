<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();

use \App\Core\Router;
use \App\Core\Application;
use \App\Controller\PageController;
use \App\Controller\ArticleController;
use \App\Controller\AdminController;
use \App\Controller\AuthController;
use \App\Controller\UserController;

require_once 'bootstrap.php';

$router = new Router();

$router->get('/', PageController::class . '@index');
$router->post('/', PageController::class . '@addSubscribe');
$router->get('/about', PageController::class . '@about');
$router->get('/logout', PageController::class . '@logout');

$router->get('/articles/*', ArticleController::class . '@article');

$router->get('/admin', AdminController::class . '@index');
$router->get('/admin/articles', AdminController::class . '@allArticles');
$router->get('/admin/articles/*', \App\Core\Controller::class . '@article');

$router->get('/registration', AuthController::class . '@registration');
$router->get('/authorization', AuthController::class . '@authorization');

$router->post('/registration', UserController::class . '@add');
$router->post('/authorization', UserController::class . '@auth');

$application = new Application($router);

$application->run();
