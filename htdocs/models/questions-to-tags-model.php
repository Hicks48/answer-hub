<?php
	class Questions_To_Tags_Model {

		public static function find_tags_for_question($question_id) {

			return Tag_Model::gather_data(Utils::execute_query("
			Select tags.id, tags.name
			FROM questions_to_tags, tags
			WHERE questions_to_tags.question_id = :question_id AND questions_to_tags.tag_id = tags.id
			", array('question_id' => $question_id)));
		}

		public static function find_all_questions_of_tag($tag_id) {

			Question_Model::gather_data(Utils::execute_query("
			Select *
			FROM questions, questions_to_tags
			WHERE questions_to_tags.tag_id = :tag_id AND questions_to_tags.question_id = questions.id
			", array('tag_id' => $tag_id)));
		}

		public static function remove_tags_from_question($tags, $question) {

			foreach($tags as $tag) {
				Utils::execute_query("DELETE FROM questions_to_tags WHERE question_id = :question_id AND tag_id = :tag_id",
				array(
					'question_id' => $question->id,
					'tag_id' => $tag->id
				));
			}
		}

		public static function remove_all_tags_from_question($question) {
			Utils::execute_query("DELETE FROM questions_to_tags WHERE question_id = :question_id", array('question_id' => $question->id));
		}

		public static function add_tags_to_question($tags, $question) {

			foreach($tags as $tag) {
				Utils::execute_query("INSERT INTO questions_to_tags (question_id, tag_id) VALUES(:question_id, :tag_id)",
				array(
					'question_id' => $question->id,
					'tag_id' => $tag->id
				));
			}
		}

		public static function save_question_to_tag_relationship($questions_to_tags) {
			Utils::execute_query("INSERT INTO questions_to_tags (question_id, tag_id) VALUES(:question_id, :tag_id)",
			array('tag_id' => $questions_to_tags['tag']->id,
				'question_id' => $questions_to_tags['question']->id
			));
		}
	}
?>
