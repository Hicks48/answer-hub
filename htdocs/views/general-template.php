<html ng-app="AnswerHubApp">
	<header>
		<script src="/vendors/js/angular.min.js"></script>
		<script src="/vendors/js/jquery-2.1.1.min.js"></script>
		<script src="/vendors/js/jstorage.min.js"></script>
		
		<script src="/js/angular-app.js"></script>
		<script src="/js/angular-controllers/front-page/front-page-recently-asked.js"></script>
		<script src="/js/angular-controllers/front-page/front-page-top-rated.js"></script>
		
		<script src="/js/angular-controllers/question-page/question-controller.js"></script>
		<script src="/js/angular-controllers/question-page/question-page-answers.js"></script>
		
		<script src="/js/angular-controllers/user-page/user-controller.js"></script>
		<script src="/js/angular-controllers/user-page/user-answer-controller.js"></script>
		<script src="/js/angular-controllers/user-page/user-questions-controller.js"></script>
		<script src="/js/angular-controllers/user-page/user-edit-controller.js"></script>
		
		<script src="/js/angular-controllers/all-questions-page/all-questions-controller.js"></script>
		
		<link href="/vendors/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/css/general.css">
	</header>
	
	<body>
		<div id="top-menu">
			<h1><a href="/">AnswerHub</a></h1>
			<?php
				if(isset($_SESSION['logged_user'])) {
					$user = User_Model::find_user($_SESSION['logged_user']);
					
					echo "<a href=\"/users/show\" id=\"username-label\">" . $user->username . "</a>";
					echo "<a href=\"/logout\" id=\"logout-link\">log out</a>";
				}
				
				else {
					echo "<a href=\"/login\" id=\"login-link\">log in/create user</a>";
				}
			?>
		</div>
		
		<div id="message-box">
			<label id="message"><?php echo Utils::get_redirect_message(); ?></label>
		</div>
		
		<div id="ask-question-notification">
			<?php
				if(isset($_SESSION['logged_user'])) {
					$user = User_Model::find_user($_SESSION['logged_user']);
					
					echo "<a id=\"ask-question-link\" href=\"/questions/new\">Ask new Question</a>";
				}
				
				else {
					echo "<label>Log in or create user to start asking questions!</label>";
				}
			?>
		</div>
		
		<div id="admin-panel-notification">
			<?php
				if(isset($_SESSION['logged_user'])) {
					$user = User_Model::find_user($_SESSION['logged_user']);
					
					if($user->admin) {
						echo "<a id=\"admin-panel-link\" href=\"/admin\">Go to admin panel!</a>";
					}
				}
			?>
		</div>
		
		<?php require_once $content; ?>
	</body>
</html>