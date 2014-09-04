<?php 
require 'vendors/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

/* Routes */
$app->get('/hello', function () {
    echo "Hello";
});

$app->run();
?>