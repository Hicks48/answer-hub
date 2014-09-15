<?php
	class Question_Model {
	
		public static function find_question($id) {
			
		}
	
		public static function find_all() {
			$connection = Utils::database_connection();
			
			$find_all_query = "SELECT id, title, question, asked_by, time_asked FROM questions ORDER BY time_asked";
			
			$query = $connection->prepare($find_all_query);
			
			if($query->execute()) {
				header('location: /');
			}
			
			else {
				
			}
			
			$index = 0;
			while($line = $query->fetch()) {
				$question_object['id'] = $line['id'];
				$question_object['title'] = $line['title'];
				$question_object['question'] = $line['question'];
				$question_object['asked_by'] = $line['asked_by'];
				$question_object['time_asked'] = $line['time_asked'];
				
				$result[$index] = $question_object;
				$index ++;
			}
			
			return $result;
		}
		
		public static function save_question($question) {
			
			/* add user who asked the question */
			$question['asked_by'] = 1;
			
			/* Insert question */
			$connection = Utils::database_connection();
			
			$question_insert_query = "INSERT INTO questions (title, question, asked_by, time_asked, last_edited) 
			VALUES(:title, :question, :asked_by, NOW(), NOW())";
			
			$query = $connection->prepare($question_insert_query);
			
			if($query->execute($question)) {
				header('location: /');
			}
			
			else {
				
			}
		}
	}
?>