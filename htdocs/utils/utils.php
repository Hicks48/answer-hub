<?php
	class Utils {
		
		public static function database_connection() {
			$id = "root";
			$password = "root";

			$connection = new PDO("mysql:host=localhost;port=8889;dbname=answer-hub-db", $id, $password);
			$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
			return $connection;
		}
	}
?>