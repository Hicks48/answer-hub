<?php
	class Rating_Model {
		private $id;
		private $question_id;
		private $rating;
		
		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->question_id = $attributes['question_id'];
			$this->rating = $attributes['rating'];
		}
		
		public static function get_rating_for_question($question_id) {
			$question_id_array = [];
			$question_id_array['question_id'] = $question_id;
		
			$result = self::gather_data(Utils::execute_query("SELECT DISTINCT * FROM ratings WHERE question_id = :question_id",
			 $question_id_array));
			 
			 /* count avarage */
			 $sum = 0;
			 
			 foreach ($result as $rating) {
			 	$sum = $sum + $rating['rating'];
			 }
			 
			 return $sum / count($result);
		}
		
		public static function save_rating($rating) {
			Utils::execute_query("INSERT INTO ratings (question_id, rating) VALUES(:question_id, :rating)", $rating);
		}
		
		private static function gather_data() {
			$result = [];
			
			while($line = $query->fetch()) {

				$rating_object = new Rating_Model(array(
					'id' => $line['id'],
					'question_id' => $line['question_id'],
					'rating' => $line['rating']
				));
				
				array_push($result, $rating_object);
			}
			
			return $result;
		}
	}
?>