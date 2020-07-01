<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();

use \App\Controller\AdminController;
use \App\Controller\ArticleController;
use \App\Controller\AuthController;
use \App\Controller\CommentController;
use \App\Controller\PageController;
use \App\Controller\SubscribeController;
use \App\Controller\UserController;
use \App\Core\Application;
use \App\Core\Router;

require_once 'bootstrap.php';

$router = new Router();

$router->get('/', PageController::class . '@index');
$router->get('/about', PageController::class . '@about');
$router->get('/about', PageController::class . '@about');
$router->get('/pages/*', PageController::class . '@current');
$router->get('/unsubscribed/*', PageController::class . '@unsubscribed');

$router->post('/', SubscribeController::class . '@add');

$router->get('/articles/*', ArticleController::class . '@article');
$router->post('/articles/*', CommentController::class . '@add');

$router->get('/admin', AdminController::class . '@index');
$router->get('/admin/users', AdminController::class . '@users');
$router->post('/admin/users', AdminController::class . '@editUser');
$router->get('/admin/users/add', AdminController::class . '@addUser');
$router->post('/admin/users/add', AdminController::class . '@addUserPost');
$router->get('/admin/articles', AdminController::class . '@allArticles');
$router->post('/admin/articles', AdminController::class . '@toggleArticle');
$router->get('/admin/articles/edit/(\d+)', AdminController::class . '@article');
$router->post('/admin/articles/edit/(\d+)', AdminController::class . '@editArticle');
$router->get('/admin/articles/add', AdminController::class . '@addArticle');
$router->post('/admin/articles/add', AdminController::class . '@addArticlePost');
$router->get('/admin/subscribes', AdminController::class . '@subscribes');
$router->post('/admin/subscribes', AdminController::class . '@deleteSubscribe');
$router->get('/admin/comments', AdminController::class . '@comments');
$router->post('/admin/comments', AdminController::class . '@toggleComment');
$router->get('/admin/comments/edit/(\d+)', AdminController::class . '@comment');
$router->post('/admin/comments/edit/(\d+)', AdminController::class . '@editComment');
$router->get('/admin/pages', AdminController::class . '@pages');
$router->post('/admin/pages', AdminController::class . '@togglePage');
$router->get('/admin/pages/edit/(\d+)', AdminController::class . '@page');
$router->post('/admin/pages/edit/(\d+)', AdminController::class . '@editPage');
$router->get('/admin/pages/add', AdminController::class . '@addPage');
$router->post('/admin/pages/add', AdminController::class . '@addPagePost');
$router->get('/admin/settings', AdminController::class . '@settings');
$router->post('/admin/settings', AdminController::class . '@editSettings');



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
