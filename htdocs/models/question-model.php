<?php
	require_once 'models/user-model.php';

	class Question_Model {
		public $id;
		public $title;
		public $question;
		public $asked_by;
		public $time_asked;
		public $rating;

		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->title = $attributes['title'];
			$this->question = $attributes['question'];
			$this->asked_by = $attributes['asked_by'];
			$this->time_asked = $attributes['time_asked'];
		}

		public static function find_question($id) {
			try {
				$array = self::gather_data(Utils::execute_query("SELECT * FROM questions WHERE id=:id", array('id' => $id)));
				return $array[0];
			}

			catch(Exception $e) {
				return null;
			}
		}

		public static function find_questions_for_user($user_id) {
			return self::gather_data(Utils::execute_query("SELECT * FROM questions WHERE asked_by = :user_id", array('user_id' => $user_id)));
		}

		public static function find_all() {
			return self::gather_data(Utils::execute_query("SELECT * FROM questions ORDER BY time_asked"));
		}

		public static function save_question($question) {
			$connection = Utils::database_connection();
			$query_prepared = $connection->prepare("INSERT INTO questions (title, question, asked_by, time_asked)
			VALUES(:title, :question, :asked_by, NOW()");
			$query_prepared->execute($question);

			$array = self::gather_data(Utils::execute_query("SELECT * FROM questions WHERE id = :last_inserted_id", array('last_inserted_id' => $connection->lastInsertId())));
			return $array;
		}

		public static function edit_question($question) {
			Utils::execute_query("UPDATE questions SET title = :title, question = :question WHERE id = :id",
			array(
				'title' => $question->title,
				'question' => $question->question,
				'id' => $question->id
			));
		}

		public static function edit_tags($question, $new_tags) {
			Questions_To_Tags_Model::remove_all_tags_from_question($question);
			Questions_To_Tags_Model::add_tags_to_question($new_tags, $question);
		}

		public static function delete_question($question) {
			/* Delete answers of question */
			Utils::execute_query("DELETE FROM answers WHERE question_id = :question_id", array('question_id' => $question->id));

			/* Delete tag relationships to question */
			Questions_To_Tags_Model::remove_all_tags_from_question($question);

			/* Delete rating sor question */
			Utils::execute_query("DELETE FROM ratings WHERE question_id = :question_id", array('question_id' => $question->id));

			/* Delete question */
			Utils::execute_query("DELETE FROM questions WHERE id = :id", array('id' => $question->id));
		}

		public static function do_search($tags) {
			$tag_query = '';
			for($i = 0;$i < count($tags);$i ++) {

				if($i == count($tags) - 1) {
					$tag_query = $tag_query . 'tags.id = ' . $tags[$i]->id;
				}

				else {
					$tag_query = $tag_query . 'tags.id = ' . $tags[$i]->id . ' OR ';
				}
			}

			$query =
			'SELECT DISTINCT questions.id, questions.title, questions.question, questions.asked_by, questions.time_asked
			FROM questions, questions_to_tags, tags
			WHERE questions_to_tags.question_id = questions.id AND questions_to_tags.tag_id = tags.id AND tags.id IN ( SELECT id FROM tags WHERE ' . $tag_query .
			') ORDER BY questions.time_asked';

			return self::gather_data(Utils::execute_query($query));
		}

		private static function gather_data($query) {
			$result = array();

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
