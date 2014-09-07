<?php 
require 'vendor/Slim/Slim.php';

/* Require all controllers */
foreach(glob('controller/*') as controller) {
	require controller;
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

/* Routes */
$app->get('/', FrontPageController::show());

$app->get('/user/$id', function ($id) {
    echo "Hello";
});

$app->run();
?>