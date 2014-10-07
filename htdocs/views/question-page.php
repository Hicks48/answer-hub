
<div ng-controller="QuestionController">
	
	<h2 id="question-title">{{question.title}}<h2>
	<label id="question-asked-by">Asked By: {{question.asked_by.username}} at {{question.time_asked}}</label><br>
	
	<div id="rating-container">
		<label id="question-rating">Rating: {{rating}}</label><br>
	
		<?php
			if(isset($_SESSION['logged_user'])) {
				$user = $user = User_Model::find_user($_SESSION['logged_user']);
				$parsed = explode("/", $_SERVER['REQUEST_URI']);
				$question_id = $parsed[count($parsed) - 1];
				$question = Question_Model::find_question($question_id);
				
				if(!Rating_Model::user_has_given_rating($user, $question_id) && !($question->asked_by->id == $_SESSION['logged_user'])) {
				
					echo "<label>RateQuestion</label><br>";
					echo '<div id=\"rate-question\">
							<form method="post" action="/ratings/create/' . $question_id . '">
								<label>Give rating from 0-5:</label>
								<input type="text" name="rating">
								<input type="submit" value="submit rating" class="btn btn-default">
							</form>
						</div>';
				}
				
				else if($question->asked_by->id == $_SESSION['logged_user']) {
					echo "You cant rate your own question.";
				}
				
				else {
					echo "You have already rated this question!";
				}
			}
			
			else {
				echo "<label>Log in or create user to rate this question!</label>";
			}
		?>
	</div>
	
	<div id="question-tags-container">
		<label>Tags:</label><br>
		<ul class="list-inline">
			<li ng-repeat="tag in tags"><span class="label label-info">{{tag.name}}</span></li>
		</ul>
	</div>
	
	<br><br>
	
	<div id="question-panel" class="panel panel-default">
		<p>{{question.question}}</p>
	</div>
	
	<div id="question-administration-panel">
		<?php
			if(isset($_SESSION['logged_user'])) {
				$parsed = explode("/", $_SERVER['REQUEST_URI']);
				$question_id = $parsed[count($parsed) - 1];
				$question = Question_Model::find_question($question_id);
			
				if($question->asked_by->id == $_SESSION['logged_user']) {
					echo '<ul class="list-inline">
							<li><form method="get" action="/questions/edit/' . $question_id .'">
								<input type="submit" value="edit question" class="btn btn-default">
							</form></li>
							<li><form method="post" action="/questions/delete/' . $question_id . '">
								<input type="submit" value="delete question" class="btn btn-danger">
							</form></li>
						</ul>';
				}
			}
		?>
	</div>
	
	<div ng-controller="QuestionAnswerController">
		<?php if($data['user']): ?>
		<div id="question-answer-form">
			<h2>Create Answer</h2>
			<div class="alert alert-success" ng-show="create_answer_message">{{create_answer_message}}</div>
			<div class="alert alert-danger" ng-show="create_answer_fail_message">{{create_answer_fail_message}}</div>
			<form ng-submit="send_answer()">
				<div class="form-group">
					<label>Answer:</label>
					<textarea rows="12" cols="50" name="question" class="form-control" ng-model="answer"></textarea>
				</div>
			
				<input type="submit" value="post answer" class="btn btn-default">
			</form>
		</div>
		<?php endif; ?>
		
		<div>
			<table class="table">
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