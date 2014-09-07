<?php
	require 'model/question-model.php';
	
	class FrontPageController {
	
		public static function show() {
			require 'view/front-page.php';
			//json_encode(Question::find_all());
		}
	
	}

?>