<div ng-controller="QuestionEditController">
	<form method="post" action="/questions/edit/<?php echo $data['id']; ?>">
		<div class="form-group">
			<label>Title:</label>
			<input type="text" name="title" ng-model="question.title" class="form-control">
		</div>
				
		<div class="form-group">
			<label>Question:</label>
			<textarea rows="12" cols="50" name="question" ng-model="question.question" class="form-control"></textarea>
		</div>
				
		<div class="form-group">
			<label>Tags:</label>
			<input type="text" name="tags" class="form-control" ng-model="tags">
		</div>
				
		<input type="submit" value="post edition to question">
	</form>
</div>

<script>
	$.jStorage.set('id', <?php echo $data['id']; ?>);
</script>