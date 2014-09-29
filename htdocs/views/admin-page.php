<div>
	<label>All Questions</label>
	<table class="table">
		<tr ng-repeat="q in questions">
			<td><a href="/questions/{{q.id}}">{{q.title}}</a></td>
			<td>{{q.time_asked}}</td>
			<td>{{q.asked_by.username}}</td>
			<td><input type="submit" value="edit"></td>
			<td><input type="submit" value="delete"></td>
		</tr>
	</table>
</div>
	
<div>
	<label>All answers</label>
	<table class="table">
		<tr ng-repeat="a in answers">
			<td><a href="/questions/{{a.question_id.id}}">{{a.question_id.title}}</a></td>
			<td><input type="submit" value="edit"></td>
			<td><input type="submit" value="delete"></td>
		</tr>
	</table>
</div>

<div>
	<label>All users<label>
</div>

<div>
	<label>All tags</label>
</div>