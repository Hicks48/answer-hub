<?php
	class User_Model {
		private $id;
		private $username;
		private $password;
		
		public function get_id() {
			return $id;
		}
		
		public function get_username() {
			return $username;
		}
		
		public function check_password($given_password) {
			return $given_password == $password;
		}
		
		public static function find_user($id) {
			$connection = Utils::database_connection();
			
			$user_query = "SELECT username, FROM users WHERE id = :id";
			
			$query = $connection->prepare($user_query);
			
			if($query->execute($id)) {
				header('location: /');
			}
			
			else {
				
			}
		}
		
		public static function find_log_in($given_username, $given_password) {
			
		}
		
		public static function save_user($user) {
						
			/* Insert user */
			$connection = Utils::database_connection();
			
			$user_insert_query = "INSERT INTO users (username, password, email) 
			VALUES(:username, :password, :email)";
			
			$query = $connection->prepare($user_insert_query);
			
			if($query->execute($user)) {
				header('location: /');
			}
			
			else {
				
			}
		}
	}
?>