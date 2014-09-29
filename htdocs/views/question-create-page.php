<form method="post" action="/questions/create">
	<div class="form-group">
		<label>Title:</label>
		<input type="text" name="title" class="form-control">
	</div>
			
	<div class="form-group">
		<label>Question:</label>
		<textarea rows="12" cols="50" name="question" class="form-control"></textarea>
	</div>
			
	<div class="form-group">
		<label>Tags:</label>
		<input type="text" name="tags" class="form-control">
	</div>
			
	<input type="submit" value="post question">
</form>