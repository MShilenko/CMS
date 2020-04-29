<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

$router = new \App\Classes\Router();

// $router->get('/',     function() {
//     return 'home';
// });
// $router->get('/about', function() {
//     return 'about';
// });

$router->get('/',      \App\Classes\Controller::class . '@index');
$router->get('/about', \App\Classes\Controller::class . '@about');

$application = new \App\Classes\Application($router);


$application->run();
