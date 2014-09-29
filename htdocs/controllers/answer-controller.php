<?php
	require_once 'models/answer-model.php';

	class Answer_Controller {
		
		public static function create_answer() {
					
			if(!isset($_SESSION['logged_user'])) {
				echo "ERROR";
				return;
			}
		
			$answer = array(
				'question_id' => $_POST['question_id'],
				'answer_by' => $_SESSION['logged_user'],
				'answer' => $_POST['answer']
			);	
	
			Answer_Model::save_answer($answer);
		}
	}
?>