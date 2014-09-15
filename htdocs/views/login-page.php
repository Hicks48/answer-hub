<html>
	<head>
		<link href="vendors/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/general.css">
	</head>
	
	<body>
		<div id="log-in-form">
			<h3>Log In<h3>
		
			<form method="post" action="/users/login">
				<div class="form-group">
					<label>username:</label>
					<input type="text" name="username" class="form-control">
				</div>
				
				<div class="form-group">
					<label>password:</label>
					<input type="password" name="password" class="form-control">
				</div>
				
				<input type="submit" value="log in">
			</form>
		</div>
		
		<div id="new-user-form">
			<h3>New User</h3>
		
			<form method="post" action="/users/create">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
				</div>
				
				
				<div class="form-group">
					<label>email:</label> 
					<input type="email" name="email" class="form-control">
				</div>
								
				<div class="form-group">
					<label>password:</label>
					<input type="password" name="pass" class="form-control">
				</div>
								
				<div class="form-group">
					<label>password again:</label> 
					<input type="password" name="pass-again" class="form-control">
				</div>
								
				<input type="submit" value="create user">
			</form>
		</div>
	</body>
	
</html>