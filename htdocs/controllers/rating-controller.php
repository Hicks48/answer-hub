<?php
	require_once 'models/rating-model.php';

	class Rating_Controller {
		
		public static function top_rated_questions($amount) {
			$top_rated = Rating_Model::get_top_rated($amount);
			
			foreach($top_rated as $question) {
				$question->rating = Rating_Model::get_rating_for_question($question->id);
			}
			
			return $top_rated;
		}
		
		public static function get_rating_for_question($question_id) {
			return Rating_Model::get_rating_for_question($question_id);
		}
		
		public static function create_rating($question_id) {
			
			if(!isset($_SESSION['logged_user'])) {
				Utils::throw_exception();
				return;
			}
			
			if(!self::validate_rating($_POST['rating'])) {
				Utils::redirect_to('/questions/' . $question_id, "Rating failed! Rating must be between 0 and 5!");
				return;
			}
						
			Rating_Model::save_rating(array('question_id' => $question_id, 'rating' => $_POST['rating'], 'rated_by' => $_SESSION['logged_user']));
			Utils::redirect_to('/questions/' . $question_id, "Rating succesful!");
		}
		
		private static function validate_rating($rating) {
			
			if(0 <= $rating && $rating <= 5) {
				return true;
			}
			
			return false;
		}
	}
?>