<?php
	class User_Model {
		public $id;
		public $username;
		public $password;
		public $email;
		public $admin;
		
		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->username = $attributes['username'];
			$this->password = $attributes['password'];
			$this->email = $attributes['email'];
			$this->admin = $attributes['admin'];
		}
		
		public static function find_user($id) {			
			return self::gather_data(Utils::execute_query("SELECT * FROM users WHERE id = :id LIMIT 1", array('id' => $id)))[0];
		}
		
		public static function find_log_in($given_username, $given_password) {
			$attributes = [];
			$attributes['username'] = $given_username;
			$attributes['password'] = $given_password;
			
			return self::gather_data(Utils::execute_query("SELECT * FROM users WHERE username = :username AND password = :password", $attributes))[0];
		}
		
		public static function save_user($user) {
			
			Utils::execute_query("INSERT INTO users (username, password, email)
			VALUES(:username, :password, :email)", $user);
		}
		
		public static function update_user_info($user) {
			Utils::execute_query("UPDATE users SET username = :username, email = :email WHERE id = :id", array('id' => $user->id, 'username' => $user->username, 'email' => $user->email));
		}
		
		public static function update_user_password($user) {
			Utils::execute_query("UPDATE users SET password = :password WHERE id = :id", array('id' => $user->id, 'password' => $user->password));
		}
		
		public static function delete_user($user) {
			/* Update users questions */
			Utils::execute_query("UPDATE questions SET asked_by = :removed_user WHERE asked_by = :id", array('asked_by' => $user->id, 'removed_user' => 99));
			
			/* Update users answers */
			Utils::execute_query("UPDATE answers SET answer_by = :removed_user WHERE answer_by = :id", array('answer_by' => $user->id, 'removed_user' => 99));
			
			Utils::execute_query("DELETE FROM users WHERE id = :id", array('id' => $user->id));
		}
		
		private static function gather_data($query) {
			$result = [];
			
			while($line = $query->fetch()) {

				$user_object = new User_Model(array(
					'id' => $line['id'],
					'username' => $line['username'],
					'password' => $line['password'],
					'email' => $line['email'],
					'admin' => $line['admin']
				));
				
				array_push($result, $user_object);
			}
			
			return $result;
		}
	}
?>