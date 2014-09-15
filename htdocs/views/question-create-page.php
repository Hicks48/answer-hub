<html>
	<head>
		<link href="/vendors/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/css/general.css">
	</head>
	
	<body>
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
	</body>
</html>