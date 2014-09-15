<?php
	require_once 'models/question-model.php';

	class Question_Controller {
		
		public static function show($id) {
			require_once 'views/question-page.php';
		}
		
		public static function create_page() {
			require_once 'views/question-create-page.php';
		}
		
		public static function create_question() {
			Question_Model::save_question(array('title' => $_POST['title'], 'question' => $_POST['question']));
		}
	}
?>