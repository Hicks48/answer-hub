<?php
	require_once 'models/user-model.php';
	
	class Question_Model {
		public $id;
		public $title;
		public $question;
		public $asked_by;
		public $time_asked;
		
		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->title = $attributes['title'];
			$this->question = $attributes['question'];
			$this->asked_by = $attributes['asked_by'];
			$this->time_asked = $attributes['time_asked'];
		}
	
		public static function find_question($id) {
			$id_array['id'] = $id;
			return self::gather_data(Utils::execute_query("SELECT * FROM questions WHERE id=:id", $id_array))[0];
		}
		
		public static function find_questions_for_user($user_id) {
			return self::gather_data(Utils::execute_query("SELECT * FROM questions WHERE asked_by = :user_id", array('user_id' => $user_id)));
		}
	
		public static function find_all() {
			return self::gather_data(Utils::execute_query("SELECT * FROM questions ORDER BY time_asked"));
		}
		
		public static function save_question($question) {
			$question['asked_by'] = 1;
									
			Utils::execute_query("INSERT INTO questions (title, question, asked_by, time_asked, last_edited) 
			VALUES(:title, :question, :asked_by, NOW(), NOW())", $question);
			
			return self::gather_data(Utils::execute_query("SELECT * FROM questions WHERE id = LAST_INSERT_ID()"));
		}
		
		public static function edit_question($question) {
			
		}
		
		public static function delete_question($question) {
			/* Delete answers of question */
			Utils::execute_query("DELETE FROM answers WHERE question_id = :question_id", array('question_id' => $question->id));
			
			/* Delete tag relationships to question */
			Utils::execute_query("DELETE FROM questions_to_tags WHERE question_id = :question_id", array('question_id' => $question->id));
			
			/* Delete question */
			Utils::execute_query("DELETE FROM questions WHERE id = :id", array('id' => $question->id));
		}
		
		private static function gather_data($query) {
			$result = [];
			
			while($line = $query->fetch()) {

				$question_object = new Question_Model(array(
					'id' => $line['id'],
					'title' => $line['title'],
					'question' => $line['question'],
					'asked_by' => User_Model::find_user((int)$line['asked_by']),
					'time_asked' => $line['time_asked']
				));
				
				array_push($result, $question_object);
			}
			
			return $result;
		}
	}
?>