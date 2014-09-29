<?php
	require_once 'models/question-model.php';

	class Question_Controller {
		
		public static function show($id) {
			Utils::render_content('views/question-page.php', array("id" => $id));
		}
		
		public static function all_questions_page() {
			Utils::render_content('views/all-questions.php');
		}
		
		public static function create_page() {
			Utils::render_content('views/question-create-page.php');
		}
		
		public static function create_question() {
			
			if(!isset($_SESSION['logged_user'])) {
				Utils::redirect_to('/');
			}
		
			$question = Question_Model::save_question(
			array(
				'title' => $_POST['title'],
				'question' => $_POST['question'],
				'asked_by' => $_SESSION['logged_user']
			));
			
			Utils::redirect_to('/');
		}
	}
?>