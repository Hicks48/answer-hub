<?php
	class Rating_Model {
		public $id;
		public $question_id;
		public $rating;
		public $rated_by;

		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->question_id = $attributes['question_id'];
			$this->rating = $attributes['rating'];
		}

		public static function user_has_given_rating($user_id, $question_id) {
			$result = self::gather_data(Utils::execute_query("SELECT * FROM ratings WHERE rated_by = :user_id AND question_id = :question_id", array('user_id' => $user_id, 'question_id' => $question_id)));

			if(empty($result)) {
				return false;
			}

			return true;
		}

		public static function get_rating_for_question($question_id) {
			$question_id_array = array();
			$question_id_array['question_id'] = $question_id;

			$result = self::gather_data(Utils::execute_query("SELECT DISTINCT * FROM ratings WHERE question_id = :question_id",
			 $question_id_array));

			 /* no ratings found for question */
			 if(empty($result)) {
			 	return 'not yet rated';
			 }

			 /* count avarage */
			 $sum = 0;

			 foreach ($result as $rating) {
			 	$sum = $sum + $rating->rating;
			 }

			 return $sum / count($result);
		}

		public static function get_top_rated($amount) {
			$query = Utils::execute_query("
			SELECT question_id, AVG(ratings.rating) as avg_rating
			FROM ratings
			GROUP BY question_id
			ORDER BY avg_rating
			LIMIT " . $amount
			);

			$questions = array();

			while($line = $query->fetch()) {
				array_push($questions, Question_Model::find_question((int)$line['question_id']));
			}

			return $questions;
		}

		public static function save_rating($rating) {
			Utils::execute_query("INSERT INTO ratings (question_id, rating, rated_by) VALUES(:question_id, :rating, :rated_by)", $rating);
		}

		private static function gather_data($query) {
			$result = array();

			while($line = $query->fetch()) {

				$rating_object = new Rating_Model(array(
					'id' => $line['id'],
					'question_id' => Question_Model::find_question((int)$line['question_id']),
					'rating' => $line['rating'],
					'rated_by' => User_Model::find_user((int)$line['rated_by'])
				));

				array_push($result, $rating_object);
			}

			return $result;
		}
	}
?>
