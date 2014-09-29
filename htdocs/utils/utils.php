<?php
	class Utils {
		private static $redirect_message;
		
		public static function database_connection() {
			$id = "root";
			$password = "root";

			$connection = new PDO("mysql:host=localhost;port=8889;dbname=answer-hub-db", $id, $password);
			$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
			return $connection;
		}
		
		public static function execute_query($query, $atrribute_values = array()) {
			$connection = self::database_connection();
						
			$query_prepared = $connection->prepare($query);
			
			$query_prepared->execute($atrribute_values);
			
			return $query_prepared;
		}
		
		public static function render_content($content, $data = array()) {
			require_once "views/general-template.php";
		}
		
		public static function redirect_to($url, $message = "") {
			header('Location: ' . $url);
			self::$redirect_message = $message;
			exit();
		}
		
		public static function get_redirect_message() {
			
			if(is_null(self::$redirect_message)) {
				return "";
			}
			
			return self::$redirect_message;
		}
		
		public static function throw_exception() {
			header("HTTP/1.1 500 Internal Server Error");
		}
	}
?>