<?php
	class Tag_Model {
		public $id;
		public $name;
		
		public function __construct($attributes) {
			$this->id = $attributes['id'];
			$this->name = $attributes['name'];
		}
		
		public static function find_all() {
			self::gather_data(Utils::execute_query("SELECT * FROM tags"));
		}
		
		public static function save_tag($name) {
			$name_array = [];
			$name_array['name'] = $name;
			
			Utils::execute_query("INSERT INTO tags (name) VALUES(:name)", $name_array);
		}
		
		private static function gather_data($query) {
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