<?php
	class User_Controller {
		
		public static function show($id) {
			User_Model::find_user($id);
		}
		
		public static function create_user() {
			User_Model::save_user();
			header('location: /');
		}
		
		public static function edit($id) {
			
		}
		
		public static function show_log_in_page() {
			Utils::render_content('views/login-page.php');
		}
		
		public static function log_in() {
			
		}
	}
?>