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
			try {
				$array = self::gather_data(Utils::execute_query("SELECT * FROM users WHERE id = :id LIMIT 1", array('id' => $id)));
				return $array[0];
			}

			catch(Exception $e) {
				return null;
			}
		}

		public static function find_log_in($given_username, $given_password) {
			$attributes = array();
			$attributes['username'] = $given_username;
			$attributes['password'] = $given_password;

			try {
				$array = self::gather_data(Utils::execute_query("SELECT * FROM users WHERE username = :username AND password = :password", $attributes));
				return $array[0];
			}

			catch(Exception $e) {
				return null;
			}
		}

		public static function save_user($user) {

			$connection = Utils::database_connection();
			$query_prepared = $connection->prepare("INSERT INTO users (username, password, email)
			VALUES(:username, :password, :email)");
			$query_prepared->execute($user);

			$array = self::gather_data(Utils::execute_query("SELECT * FROM users WHERE id = :id", array('id' => $connection->lastInsertId())));
			return $array[0];
		}

		public static function update_user_info($user) {
			Utils::execute_query("UPDATE users SET username = :username, email = :email WHERE id = :id", array('id' => $user->id, 'username' => $user->username, 'email' => $user->email));
		}

		public static function update_user_password($user) {
			Utils::execute_query("UPDATE users SET password = :password WHERE id = :id", array('id' => $user->id, 'password' => $user->password));
		}

		public static function delete_user($user) {
			/* Delete ratings of user */
			Utils::execute_query("DELETE FROM ratings WHERE rated_by = :id", array('id' => $user->id));

			/* Delete answers */
			Utils::execute_query("DELETE FROM answers WHERE answer_by = :id", array('id' => $user->id));

			/* Delete questions */
			$users_questions = Question_Model::gather_data(Utils::execute_query("Select * FROM questions WHERE asked_by = :id", array('id' => $user->id)));
			for($i = 0;$i < count($users_questions);$i = $i + 1) {
				Question_Model::delete_question($users_questions[$i]);
			}

			//Utils::execute_query("DELETE FROM questions WHERE asked_by = :id", array('id' => $user->id));

			/* Delete user */
			Utils::execute_query("DELETE FROM users WHERE id = :id", array('id' => $user->id));
		}

		private static function gather_data($query) {
			$result = array();

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
