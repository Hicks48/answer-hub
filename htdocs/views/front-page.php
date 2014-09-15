<html ng-app="AnswerHubApp">
	<head>
		<title>AnswerHub</title>
		<script src="/vendors/js/angular.min.js"></script>
		<script src="/js/angular-controllers/front-page-recently-asked.js"></script>
		
		<link href="vendors/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/general.css">
	</head>
	
	<body>
		
		<div id="top-menu">
			<h1 class="answer-hub-logo">AnswerHub</h1>
		</div>
		
		<div id="search-view" class="table table-striped">
			<h2>Search</h2>
			<form>
				<input type="text" name="search-input">
				<input type="submit" value="search">
			</form>
			
			<table class="table">
				<tr>
					<td></td>
				</tr>
			</table>
		</div>
		
		<div id="recently-asked-view" ng-controller="RecentlyAskedController"  class="table table-striped">
			<h2>Recently asked</h2>
			
			<table class="table">
				<tr ng-repeat="q in recent_questions">
					<td><a href="/questions/{{q.id}}">{{q.title}}</a></td>
					<td>{{q.time_asked}}</td>
					<td>{{q.asked_by}}</td>
				</tr>
			</table>
		</div>
		
		<div id="top-rated-view">
			<h2>Top rated questions</h2>
			
			<table>
				<tr>
					<td></td>
				</tr>
			</table>
		</div>
	</body>
</html>