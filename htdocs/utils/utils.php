<?php
	require_once 'models/user-model.php';

	class Utils {
		public static function database_connection() {
			$id = "root";
			$password = "root";

			$connection = new PDO("mysql:host=localhost;port=8889;dbname=answer-hub-db", $id, $password);
			$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$connection->exec("SET NAMES utf8");

			return $connection;
		}

		public static function execute_query($query, $atrribute_values = array()) {
			$connection = self::database_connection();

			$query_prepared = $connection->prepare($query);

			$query_prepared->execute($atrribute_values);

			return $query_prepared;
		}

		public static function render_content($content, $data = array()) {

			if(isset($_SESSION['logged_user'])) {
				$data['user'] = User_Model::find_user($_SESSION['logged_user']);
			}

			else {
				$data['user'] = null;
			}

			$data['message'] = self::get_redirect_message();

			require_once "views/general-template.php";
		}

		public static function redirect_to($url, $message = "") {
			header('Location: ' . $url);
			$_SESSION['message'] = $message;
			exit();
		}

		public static function get_redirect_message() {
			$message = "";

			if(isset($_SESSION['message'])) {
				$message = $_SESSION['message'];
				unset($_SESSION['message']);
			}

			return $message;
		}

		public static function throw_exception() {
			header("HTTP/1.1 500 Internal Server Error");
			exit();
		}
	}
?>
