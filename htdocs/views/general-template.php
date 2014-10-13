<html ng-app="AnswerHubApp">
	<head>
		<meta charset="utf-8"/>
		<script src="/vendors/js/angular.min.js"></script>
		<script src="/vendors/js/jquery-2.1.1.min.js"></script>
		<script src="/vendors/js/jstorage.min.js"></script>

		<script src="/js/angular-app.js"></script>
		<script src="/js/angular-controllers/front-page/front-page-recently-asked.js"></script>
		<script src="/js/angular-controllers/front-page/front-page-top-rated.js"></script>
		<script src="/js/angular-controllers/front-page/front-page-search-controller.js"></script>

		<script src="/js/angular-controllers/question-page/question-controller.js"></script>
		<script src="/js/angular-controllers/question-page/question-page-answers.js"></script>

		<script src="/js/angular-controllers/user-page/user-controller.js"></script>
		<script src="/js/angular-controllers/user-page/user-answer-controller.js"></script>
		<script src="/js/angular-controllers/user-page/user-questions-controller.js"></script>
		<script src="/js/angular-controllers/user-page/user-edit-controller.js"></script>

		<script src="/js/angular-controllers/all-questions-page/all-questions-controller.js"></script>
		<script src="/js/angular-controllers/question-edit-page/question-edit-controller.js"></script>

		<link href="/vendors/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/css/general.css">
	</head>

	<body>
		<div id="top-menu">
			<h1><a href="/">AnswerHub</a></h1>
			<div id="logout-link">
			<?php if(!is_null($data['user'])): ?>
					<a href="/users/show" id="username-label"> <?php echo $data['user']->username; ?> </a>
					<a href="/logout">log out</a>
			<?php else: ?>
					<a href="/login" id="login-link">log in/create user</a>
			<?php endif; ?>

			</div>
		</div>

		<?php if(!is_null($data['message']) && $data['message'] != ""): ?>
			<div id="message-box">
					<label id="message"> <?php echo $data['message']; ?> </label>
			</div>
		<?php endif; ?>

		<div id="ask-question-notification">
			<?php if(!is_null($data['user'])): ?>
				<a id="ask-question-link" href="/questions/new">Ask new Question</a>
			<?php else: ?>
					<label>Log in or create user to start asking questions!</label>
			<?php endif; ?>
		</div>

		<?php require_once $content; ?>
	</body>
</html>
