<div id="search-view" class="table table-striped">
	<p>All questions can be found from <a href="/questions/all">here</a></p>

	<h2>Search By Tag</h2>
	<div ng-controller="SearchController">
		<div class="alert alert-danger" ng-show="results_message">{{results_message}}</div>
		<form ng-submit="do_search()">
			<input type="text" name="search-input" ng-model="search_input">
			<input type="submit" value="search" class="btn btn-success">
		</form>
				
		<table class="table">
			<tr ng-repeat="q in search_results">
				<td><a href="/questions/{{q.id}}">{{q.title}}</a></td>
				<td>{{q.time_asked}}</td>
				<td>{{q.asked_by.username}}</td>
			</tr>
		</table>
	</div>
</div>
		
<div id="recently-asked-view" ng-controller="RecentlyAskedController"  class="table table-striped">
	<h2>Recently asked</h2>
			
	<table class="table">
		<tr ng-repeat="q in recent_questions">
			<td><a href="/questions/{{q.id}}">{{q.title}}</a></td>
			<td>{{q.time_asked}}</td>
			<td>{{q.asked_by.username}}</td>
		</tr>
	</table>
</div>
		
<div id="top-rated-view" ng-controller="TopRatedController" class="table table-striped">
	<h2>Top rated questions</h2>
			
	<table class="table">
		<tr ng-repeat="q in top_rated_questions">
			<td>{{q.rating}}</td>
			<td><a href="/questions/{{q.id}}">{{q.title}}</a></td>
			<td>{{q.time_asked}}</td>
			<td>{{q.asked_by.username}}</td>
		</tr>
	</table>
</div>