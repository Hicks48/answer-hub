
<div ng-controller="QuestionController">
	
	<h2>{{question.title}}<h2>
	<label>{{question.time_asked}}</label>
	
	<div class="panel panel-default">
		<p>{{question.question}}</p>
	</div>
	
	<div>
		<table ng-controller="">
			<tr ng-repeat="a in answers">
				<td>
					<div>
						<p>{{a.answer}}</p>
						<label>{{a.answer_by}}</label>
						<label>{{a.time_answered}}</label>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="questionId" data-questionId="<?php echo $data['id']; ?>"></div>