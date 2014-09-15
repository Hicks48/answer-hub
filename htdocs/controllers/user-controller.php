<?php
	class User_Controller {
		
		public static function show($id) {
			User_Model::find_user($id);
		}
		
		public static function create_user() {
			User_Model::save_user();
		}
		
		public static function edit($id) {
			
		}
		
		public static function show_log_in_page() {
			require 'views/login-page.php';
		}
		
		public static function log_in() {
			
		}
	}
?>