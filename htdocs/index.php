<?php 
require_once 'vendors/Slim/Slim.php';
require_once 'utils/utils.php';

/* Require all controllers */
foreach(glob('controllers/*') as $controller) {
	require $controller;
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

/* Routes */

/* front page */
$app->get('/', function(){
	Frontpage_Controller::show();
});

/* Log in/new user page */
$app->get('/login', function(){
	User_Controller::show_log_in_page();
});

/* questions page */
$app->get('/questions/:id', function($id) {
	Question_Controller::show($id);
});

/* new question page */
$app->get('/questions/new', function() {
	Question_Controller::create_page();
});

/* create question */
$app->post('/questions/create', function() {
	Question_Controller::create_question();
});

/* user page */
$app->get('/users/:id', function($id) {
	
});

/* create user */
$app->post('/users/create', function(){
	User_Controller::createUser();
});

/* user edit page */
$app->get('/users/:id/edit', function($id) {
	
});

/* Resources */

/* all questions */
$app->get('/questions-json', function() {
	echo json_encode(Question_Model::find_all());
});

/* question with id */
$app->get('/questions-json/:id', function($id) {
	
});

/* questions search */
$app->get('/questions-json/search', function() {
	
});

/* user with id */
$app->get('/users-json/:id', function($id) {
	
});

$app->run();
?>