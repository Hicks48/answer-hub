<html ng-app="AnswerHubApp">
	<header>
		<script src="/vendors/js/angular.min.js"></script>
		<script src="/vendors/js/jquery-2.1.1.min.js"></script>
		
		<script src="/js/angular-app.js"></script>
		<script src="/js/angular-controllers/front-page/front-page-recently-asked.js"></script>
		<script src="/js/angular-controllers/front-page/front-page-top-rated.js"></script>
		
		<script src="/js/angular-controllers/question-page/question-controller.js"></script>
		
		<link href="/vendors/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/css/general.css">
	</header>
	
	<body>
		<div id="top-menu">
			<h1 id="answer-hub-title"><a href="/">AnswerHub</a></h1>
			<a href="/login" id=""login link>log in</a>
		</div>
		
		<?php require_once $content; ?>
	</body>
</html>