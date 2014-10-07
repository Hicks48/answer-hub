<?php
	class Tag_Model {
		public $id;
		public $name;
		
		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->name = $attributes['name'];
		}
		
		public static function find_all() {
			return self::gather_data(Utils::execute_query("SELECT * FROM tags"));
		}
		
		public static function find_tag($id) {
			try {
				return self::gather_data(Utils::execute_query("SELECT * FROM tags WHERE id = :id", array('id' => $id)))[0];
			}
			
			catch(Exception $e) {
				return null;
			}
		}
		
		public static function find_tag_by_name($name) {
		
			try {
				return self::gather_data(Utils::execute_query("SELECT * FROM tags WHERE name = :name", array('name' => $name)))[0];
			}
			
			catch(Exception $e) {
				return null;
			}
		}
		
		public static function save_tag($name) {
			$connection = Utils::database_connection();
			$query_prepared = $connection->prepare("INSERT INTO tags (name) VALUES(:name)");
			$query_prepared->execute(array('name' => $name));
						
			return self::gather_data(Utils::execute_query("SELECT * FROM tags WHERE id = :last_inserted_id", array('last_inserted_id' => $connection->lastInsertId())))[0];
		}
				
		public static function gather_data($query) {
			$result = [];
			
			while($line = $query->fetch()) {

				$tag_object = new Tag_Model(array(
					'id' => $line['id'],
					'name' => $line['name']
				));
				
				array_push($result, $tag_object);
			}
			
			return $result;
		}
	}
?>