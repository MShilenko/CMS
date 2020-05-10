<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new \App\CoreClasses\Router();

$router->get('/', \App\CoreClasses\Controller::class . '@index');
$router->get('/about', \App\CoreClasses\Controller::class . '@about');
$router->get('/books', \App\CoreClasses\Controller::class . '@allBooks');
$router->get('/book/(\d+)', \App\CoreClasses\Controller::class . '@book');

$router->get('/test/*/test2/*', function ($param1, $param2) {
    return "Test page with param1=$param1 param2=$param2";
});

$application = new \App\CoreClasses\Application($router);

$application->run();
