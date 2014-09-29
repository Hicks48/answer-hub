
<div ng-controller="QuestionController">
	
	<h2>{{question.title}}<h2>
	<label>{{question.time_asked}}</label>
	
	<div class="panel panel-default">
		<p>{{question.question}}</p>
	</div>
	
	<div id="rate-question">
		
	</div>
	
	<div ng-controller="QuestionAnswerController">
		<div>
			<h2>Create Answer</h2>
			<form ng-submit="send_answer()">
				<div class="form-group">
					<label>Answer:</label>
					<textarea rows="12" cols="50" name="question" class="form-control" ng-model="answer"></textarea>
				</div>
			
				<input type="submit" value="post question">
			</form>
		</div>
		
		<div>
			<table>
				<tr ng-repeat="a in answers">
					<td>
						<div>
							<p>{{a.answer}}</p>
							<label>{{a.answer_by.username}}</label>
							<label>{{a.time_answered}}</label>
						</div>
					</td>
				</tr>
			</table>
		</div>
		
	</div>
</div>

<script>
	$.jStorage.set('id', <?php echo $data['id']; ?>);
</script>