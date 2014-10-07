<?php
	require_once 'models/question-model.php';
	require_once 'models/questions-to-tags-model.php';

	class Question_Controller {
		
		public static function show($id) {
			Utils::render_content('views/question-page.php', array("id" => $id, "user" => isset($_SESSION['logged_user']) ? $_SESSION['logged_user'] : null));
		}
		
		public static function all_questions_page() {
			Utils::render_content('views/all-questions.php');
		}
		
		public static function create_page() {
			Utils::render_content('views/question-create-page.php');
		}
		
		public static function create_question() {
			
			if(!isset($_SESSION['logged_user'])) {
				Utils::redirect_to('/');
			}
			
			if(!self::validate_question(array('title' => $_POST['title'], 'question' => $_POST['question']))) {
				Utils::redirect_to('/questions/new', "invalid question");
				return;
			}
			
			$question = Question_Model::save_question(
			array(
				'title' => $_POST['title'],
				'question' => $_POST['question'],
				'asked_by' => $_SESSION['logged_user']
			));
						
			foreach(explode(",", str_replace(" ", "", $_POST['tags'])) as $tag) {
				$found_tag = Tag_Model::find_tag_by_name($tag);
				
				if(is_null($found_tag)) {
					$found_tag = Tag_Model::save_tag($tag);
				}
				
				Questions_To_Tags_Model::save_question_to_tag_relationship(array('question' => $question, 'tag' => $found_tag));
			}
			
			Utils::redirect_to('/', "Question succesfully created!");
		}
		
		public static function edit_question_page($id) {
			Utils::render_content('views/question-edit-page.php', array("id" => $id));
		}
		
		public static function edit_question($id) {
		
			if(!self::validate_question(array('title' => $_POST['title'], 'question' => $_POST['question']))) {
				Utils::redirect_to('/questions/edit/' . $id, "Invalid question. Question and title must be included!");
				return;
			}
		
			$question = Question_Model::find_question($id);
			$question->title = $_POST['title'];
			$question->question = $_POST['question'];
			
			if(!isset($_SESSION['logged_user']) || $question->asked_by->id != $_SESSION['logged_user']) {
				Utils::redirect_to('/', "You can't edit question that you haven't asked!");
				return;
			}
			
			Question_Model::edit_question($question);
			
			$new_tags = array();
			foreach(explode(",", str_replace(" ", "", $_POST['tags'])) as $tag) {
				$found_tag = Tag_Model::find_tag_by_name($tag);
				
				if(is_null($found_tag)) {
					$found_tag = Tag_Model::save_tag($tag);
				}
				
				$new_tags[] = $found_tag;
			}
			
			Question_Model::edit_tags($question, $new_tags);
			
			Utils::redirect_to('/questions/' . $id, "Question succesfully edited!");
		}
		
		public static function delete_question($id) {
			$question = Question_Model::find_question($id);
			
			if(!isset($_SESSION['logged_user']) || $question->asked_by->id != $_SESSION['logged_user']) {
				Utils::redirect_to('/', "You can't delete question that you haven't asked!");
				return;
			}
			
			Question_Model::delete_question($question);
			Utils::redirect_to('/', "Question succesfully deleted!");
		}
		
		public static function do_search() {
			if(!isset($_POST['search_input'])) {
				Utils::throw_exception();
				return;
			}
		
			$tags = $_POST['search_input'];
			$new_tags = array();
			foreach(explode(",", str_replace(" ", "", $tags)) as $tag) {
				$found_tag = Tag_Model::find_tag_by_name($tag);
				
				if(is_null($found_tag)) {
					continue;
				}
				
				$new_tags[] = $found_tag;
			}
			
			return Question_Model::do_search($new_tags);
		}
		
		private static function validate_question($question_array) {
			if($question_array['title'] == "" || $question_array['question'] == "") {
				return false;
			}
			
			return true;
		}
	}
?>