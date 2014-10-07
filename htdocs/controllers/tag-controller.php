<?php
	require_once('models/questions-to-tags-model.php');
	require_once('models/question-model.php');
	require_once('models/tag-model.php');

	class Tag_Controller {
		
		public static function tags_for_question($question_id) {
			return Questions_To_Tags_Model::find_tags_for_question($question_id);
		}
	}
?>