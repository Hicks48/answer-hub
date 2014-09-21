<?php
	class Utils {
		
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
	}
?>