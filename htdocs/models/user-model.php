<?php
	class User_Model {
		public $id;
		public $username;
		public $password;
		public $email;
		
		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->username = $attributes['username'];
			$this->password = $attributes['password'];
			$this->email = $attributes['email'];
		}
		
		public static function find_user($id) {			
			return self::gather_data(Utils::execute_query("SELECT * FROM users WHERE id = :id"));
		}
		
		public static function find_log_in($given_username, $given_password) {
			$attributes = [];
			$attributes['username'] = $given_username;
			$attributes['password'] = $given_password;
			
			return self::gather_data(Utils::execute_query("SELECT * FROM users WHERE username = :username AND password = :password", $attributes))[0];
		}
		
		public static function save_user($user) {
			
			Utils::execute_query("INSERT INTO users (username, password, email)
			VALUES(:username, :password, :email)");
		}
		
		private static function gather_data($query) {
			$result = [];
			
			while($line = $query->fetch()) {

				$user_object = new User_Model(array(
					'id' => $line['id'],
					'username' => $line['username'],
					'password' => $line['password'],
					'email' => $line['email']
				));
				
				array_push($result, $user_object);
			}
			
			return $result;
		}
	}
?>