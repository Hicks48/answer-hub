<?php
	require_once 'models/rating-model.php';

	class Rating_Controller {
		
		public static function top_rated_questions($amount) {
			return Rating_Model::get_top_rated($amount);
		}
	}
?>