<?php
	require_once 'models/question-model.php';
	require_once 'models/user-model.php';

	class Answer_Model {
		public $id;
		public $question_id;
		public $answer_by;
		public $answer;
		public $time_answered;

		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->question_id = $attributes['question_id'];
			$this->answer = $attributes['answer'];
			$this->answer_by = $attributes['answer_by'];
			$this->time_answered = $attributes['time_answered'];
		}

		public static function find_answer($id) {
			$id_array['id'] = $id;

			try {
				$array = self::gather_data(Utils::execute_query("SELECT * FROM answers WHERE id=:id", $id_array));
				return $array[0];
			}

			catch(Exception $e) {
				return null;
			}
		}

		public static function find_all() {
			return self::gather_data(Utils::execute_query("SELECT * FROM answers ORDER BY time_answered"));
		}

		public static function find_answers_for_question($question_id) {
			return self::gather_data(Utils::execute_query("SELECT * FROM answers WHERE question_id = :question_id ORDER BY time_answered", array('question_id' => $question_id)));
		}

		public static function save_answer($answer) {
			Utils::execute_query("INSERT INTO answers (question_id, answer_by, answer, time_answered) VALUES(:question_id, :answer_by, :answer, NOW())", $answer);
		}

		public static function find_answers_of_user($user_id) {
			return self::gather_data(Utils::execute_query("SELECT * FROM answers WHERE answer_by = :user_id ORDER BY time_answered", array('user_id' => $user_id)));
		}

		private static function gather_data($query) {
			$result = array();

			while($line = $query->fetch()) {
				$answer_object = new Answer_Model(array(
					'id' => $line['id'],
					'question_id' => Question_Model::find_question($line['question_id']),
					'answer_by' => User_Model::find_user((int)$line['answer_by']),
					'answer' => $line['answer'],
					'time_answered' => $line['time_answered']
				));

				array_push($result, $answer_object);
			}

			return $result;
		}
	}
?>
