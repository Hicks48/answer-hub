<?php
	require_once 'models/question-model.php';
	
	class Frontpage_Controller {
	
		public static function show() {
			Utils::render_content('views/front-page.php');
		}
	}

?>