<div id="search-view" class="table table-striped">
	<p>All questions can be found from <a href="/questions/all">here</a></p>

	<h2>Search By Tag</h2>
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
			<td>{{q.asked_by.username}}</td>
		</tr>
	</table>
</div>
		
<div id="top-rated-view" ng-controller="TopRatedController" class="table table-striped">
	<h2>Top rated questions</h2>
			
	<table class="table">
		<tr ng-repeat="q in top_rated_questions">
			<td><a href="/questions/{{q.id}}">{{q.title}}</a></td>
			<td>{{q.time_asked}}</td>
			<td>{{q.asked_by.username}}</td>
		</tr>
	</table>
</div>