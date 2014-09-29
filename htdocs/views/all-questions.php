<p>Here is a list of all questions</p>

<div ng-controller="AllQuestionsController">
	<table class="table">
		<tr ng-repeat="q in questions">
			<td><a href="/questions/{{q.id}}">{{q.title}}</a></td>
			<td>{{q.time_asked}}</td>
			<td>{{q.asked_by.username}}</td>
		</tr>
	</table>
</div>