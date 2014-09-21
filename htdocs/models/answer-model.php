<?php
	class Answer_Model {
		public $id;
		public $question_id;
		public $answer_by;
		public $answer;
		public $time_answered;
		
		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->question_id = $attributes['question_id'];
			$this->answer_by = $attributes['answer_by'];
			$this->time_answered = $attributes['time_answered'];
		}
		
		public static function find_answer($id) {
			$id_array['id'] = $id;
			self::gather_data(Utils::execute_query("SELECT * FROM answers WHERE id=:id", $id_array))[0];
		}
		
		public static function find_all() {
			self::gather_data(Utils::execute_query("SELECT * FROM answers ORDER BY time_answered"));
		}
		
		private static function gather_data($query) {
			$result = [];
			
			while($line = $query->fetch()) {

				$answer_object = new Answer_Model(array(
					'id' => $line['id'],
					'question_id' => $line['question_id'],
					'answer_by' => $line['answer_by'],
					'answer' => $line['answer'],
					'time_answered' => $line['time_answered']
				));
				
				array_push($result, $answer_object);
			}
			
			return $result;
		}
	}
?>