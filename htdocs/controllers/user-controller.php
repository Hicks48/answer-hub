<?php

	require_once 'models/user-model.php';
	require_once 'models/answer-model.php';
	require_once 'models/question-model.php';
	
	class User_Controller {
		
		public static function show() {
			if(!isset($_SESSION['logged_user'])) {
				Utils::redirect_to('/', "You haven't logged in!");
				return;
			}
		
			Utils::render_content('views/user-page.php');
		}
		
		public static function create_user() {
			$user = array();
			
			$user['username'] = $_POST['new-user-username'];
			$user['email'] = $_POST['new-user-email'];
			$user['password'] = $_POST['new-user-password'];
			
			print_r($user);
			
			if(!self::validate_user_data($user)) {
				Utils::redirect_to('/login', "Invalid user info. Email and username must be provided!");
				return;
			}
			
			if(!self::validate_password($_POST['new-user-password'])) {
				Utils::redirect_to('/login', "Invalid password. Password must contain at least 8 characters!");
				return;
			}
			
			if($_POST['new-user-password'] =! $_POST['new-user-password-again']) {
				Utils::redirect_to('/login', "Password wasn't writen twice correctly!");
				return;
			}
			
			try {
				$created_user = User_Model::save_user($user);
				$_SESSION['logged_user'] = $created_user->id;
				Utils::redirect_to('/users/show', "Welcome to AnswerHub " . $user['username'] . "!");
			}
			
			catch(Exception $e) {
				Utils::redirect_to('/login', 'Username ' . $user['username'] . ' is already in use!');
			}
		}
		
		public static function edit_user_info() {
			$user = User_Model::find_user($_SESSION['logged_user']);
			$user->username = $_POST['username'];
			$user->email = $_POST['email'];
			
			User_Model::update_user_info($user);
		}
		
		public static function edit_password() {
			$user = User_Model::find_user($_SESSION['logged_user']);
		
			if($_POST['old_password'] != $user->password) {
				Utils::throw_exception();
				return;
			}
			
			if($_POST['new_password'] != $_POST['new_password_again']) {
				Utils::throw_exception();
				return;
			}
			
			if(!self::validate_password($_POST['new_password'])) {
				Utils::throw_exception();
				return;
			}
			
			$user->password = $_POST['new_password'];
			User_Model::update_user_password($user);
		}
		
		public static function delete_user() {
			$user = User_Model::find_user($_SESSION['logged_user']);
			
			/* log out */
			unset($_SESSION['logged_user']);
			
			User_Model::delete_user($user);
		}
		
		public static function show_log_in_page() {
			Utils::render_content('views/login-page.php');
		}
		
		public static function log_in() {
			$login_user = User_Model::find_log_in($_POST['login-username'], $_POST['login-password']);
			
			if(is_null($login_user)) {
				Utils::redirect_to('/login', "log in failed. Invalid username or password.");
				return;
			}
						
			$_SESSION['logged_user'] = $login_user->id;
			Utils::redirect_to('/', "log in succesfull");
		}
		
		public static function log_out() {
			unset($_SESSION['logged_user']);
			Utils::redirect_to('/', "log out succesfull");
		}
		
		
		private static function validate_user_data($user_table) {
			if($user_table['email'] == "" || $user_table['username'] == "") {
				return false;
			}
			return true;
		}
		
		private static function validate_password($password) {
			if(strlen($password) < 8) {
				return false;
			}
			
			return true;
		}
	}
?>