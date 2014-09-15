<?php
	require_once 'models/question-model.php';
	
	class Frontpage_Controller {
	
		public static function show() {
			require 'views/front-page.php';
		}
	}

?>