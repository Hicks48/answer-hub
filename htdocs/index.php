<?php
require_once 'vendors/Slim/Slim.php';
require_once 'utils/utils.php';
require_once 'models/answer-model.php';
require_once 'models/tag-model.php';

session_start();

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

/* Log in/new user page */
$app->get('/logout', function(){
	User_Controller::log_out();
});

$app->post('/users/login', function(){
	User_Controller::log_in();
});

$app->post('/users/delete', function() {
	User_Controller::delete_user();
});

/* new question page */
$app->get('/questions/new', function() {
	Question_Controller::create_page();
});

/* all question page */
$app->get('/questions/all', function() {
	Question_Controller::all_questions_page();
});

/* create question */
$app->post('/questions/create', function() {
	Question_Controller::create_question();
});

/* questions page */
$app->get('/questions/:id', function($id) {
	Question_Controller::show($id);
});

/* edit question page */
$app->get('/questions/edit/:id', function($id) {
	Question_Controller::edit_question_page($id);
});

/* delete question page */
$app->post('/questions/delete/:id', function($id) {
	Question_Controller::delete_question($id);
});

/* edit question */
$app->post('/questions/edit/:id', function($id) {
	Question_Controller::edit_question($id);
});

/* user page */
$app->get('/users/show', function() {
	User_Controller::show();
});

/* create user */
$app->post('/users/create', function(){
	User_Controller::create_user();
});

/* create user */
$app->post('/answers/create', function(){
	Answer_Controller::create_answer();
});

/* user edit page */
$app->post('/users/edit/user-info', function() {
	User_Controller::edit_user_info();
});

/* user edit password page */
$app->post('/users/edit/password', function() {
	User_Controller::edit_password();
});

/* create rating */
$app->post('/ratings/create/:question_id', function($question_id) {
	Rating_Controller::create_rating($question_id);
});

/* Resources */

/* all questions */
$app->get('/questions-json', function() {
	header('Content-type: application/json; charset=utf-8');
	echo json_encode(Question_Model::find_all());
	exit();
});

/* questions search */
$app->post('/questions-json/search', function() {
	echo json_encode(Question_Controller::do_search());
});

/* rating for question */
$app->get('/ratings-json/:question_id', function($question_id) {
	echo json_encode(Rating_Controller::get_rating_for_question($question_id));
});

/* top rated question */
$app->get('/questions-json/top-rated', function() {
	echo json_encode(Rating_Controller::top_rated_questions(8));
});

/* users answers */
$app->get('/users-json/answers', function() {
	echo json_encode(Answer_Model::find_answers_of_user($_SESSION['logged_user']));
});

/* users questions */
$app->get('/users-json/questions', function() {
	echo json_encode(Question_Model::find_questions_for_user($_SESSION['logged_user']));
});

/* answer for question */
$app->get('/questions-json/answers/:id', function($id) {
	echo json_encode(Answer_Model::find_answers_for_question($id));
});

/* tags for question */
$app->get('/questions-json/tags/:id', function($id) {
	echo json_encode(Tag_Controller::tags_for_question($id));
});

/* question with id */
$app->get('/questions-json/:id', function($id) {
	echo json_encode(Question_Model::find_question($id));
});

/* all tags */
$app->get('/tags-json', function() {
	echo json_encode(Tag_Model::find_all());
});

$app->run();
?>
