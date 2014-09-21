<?php
	class Questions_To_Tags_Model {
	
		public static function find_tags_for_question($question_id) {
			$question_id_array = [];
			$question_id_array['question_id'] = $question_id;
			
			Tag_Model::gather_data(Utils::execute_query("
			Select DISTINCT * 
			FROM questions_to_tags, tags
			WHERE questions_to_tags.question_id = questions_to_tags.:question_id AND questions_to_tags.tags = tags.tags_id
			", $question_id_array));
		}
		
		public static function find_all_questions_of_tag($tag_id) {
			$tag_id_array = [];
			$tag_id_array['tag_id'] = $tag_id;
			
			Question_Model::gather_data(Utils::execute_query("
			Select DISTINCT * 
			FROM questions, questions_to_tags 
			WHERE questions_to_tags.tag_id = questions_to_tags.:tag_id AND questions_to_tags.question_id = questions.question_id
			", $tag_id_array));
		}
		
		public static function save_question_to_tag_relationship($questions_to_tags) {
			Utils::execute_query("INSERT INTO questions_to_tags (question_id, tag_id) VALUES(:question_id, :tag_id)", $questions_to_tags);
		}
	}
?>