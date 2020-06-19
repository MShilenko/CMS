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
use \App\Controller\CommentController;

require_once 'bootstrap.php';

$router = new Router();

$router->get('/', PageController::class . '@index');
$router->get('/about', PageController::class . '@about');
$router->get('/about', PageController::class . '@about');
$router->get('/pages/*', PageController::class . '@current');

$router->post('/', SubscribeController::class . '@add');

$router->get('/articles/*', ArticleController::class . '@article');
$router->post('/articles/*', CommentController::class . '@add');

$router->get('/admin', AdminController::class . '@index');
$router->get('/admin/users', AdminController::class . '@users');
$router->post('/admin/users', AdminController::class . '@editUser');
$router->get('/admin/articles', AdminController::class . '@allArticles');

$router->get('/registration', AuthController::class . '@registration');
$router->get('/authorization', AuthController::class . '@authorization');

$router->get('/logout', UserController::class . '@logout');
$router->get('/users/(\d+)', UserController::class . '@profile');
$router->get('/personal-area', UserController::class . '@personal');
$router->post('/personal-area', UserController::class . '@edit');
$router->post('/registration', UserController::class . '@add');
$router->post('/authorization', UserController::class . '@auth');

$application = new Application($router);

$application->run();
