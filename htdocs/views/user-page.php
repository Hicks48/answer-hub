<div id="user-info" ng-controller="UserController">
	<h3>Your Info</h3>
	
	<table class="table">
		<tr>
			<th>username</th>
			<th>password</th>
			<th>email</th>
		</tr>
		<tr>
			<td>{{user.username}}</td>
			<td>********</td>
			<td>{{user.email}}</td>
		</tr>
	</table>
</div>
	
<div ng-controller="UserEditController">
	<div class="alert alert-success" ng-show="edit_user_message">{{edit_user_message}}</div>
	<form id="general-info-edit-form" ng-submit="edit_user_info()">
		<div class="form-group">
			<label>username</label> 
			<input type="text" name="username" ng-model="username" class="form-control">
		</div>
		
		<div class="form-group">
			<label>email</label> 
			<input type="text" name="email" ng-model="email" class="form-control">
		</div>
		
		<input type="submit" value="save user info" class="btn btn-warning">
	</form>
	<br><br>
	
	<div class="alert alert-success" ng-show="edit_password_message">{{edit_password_message}}</div>
	<div class="alert alert-danger" ng-show="edit_password_fail_message">{{edit_password_fail_message}}</div>
	<form id="password-edit-form" ng-submit="edit_password()">
		<div class="form-group">
			<label>old password</label>
			<input type="password" name="old_password" ng-model="old_password" class="form-control">
		</div>
		
		<div class="form-group">
			<label>new password</label>
			<input type="password" name="new_password" ng-model="new_password" class="form-control">
		</div>
		
		<div class="form-group">
			<label>new password again</label>
			<input type="password" name="new_password_again" ng-model="new_password_again" class="form-control">
		</div>
		
		<input type="submit" value="save password" class="btn btn-warning">
	</form>
	
	<br><br>
	
	<form>
		<input type="submit" ng-submit="delete_user()" value="delete user" class="btn btn-danger">
	</form>
</div>

<br>

<div ng-controller="UserQuestionController">
	<h3>Your Questions<h3>
	
	<ul class="list-inline">
		<li ng-repeat="q in questions"><a href="/questions/{{q.id}}">{{q.title}}</a></li>
	</ul>
</div>
		
<div ng-controller="UserAnswerController">
	<h3>Your Answers</h3>
	
	<ul class="list-inline">
		<li ng-repeat="a in answers"><a href="/questions/{{a.question_id.id}}">{{a.question_id.title}} {{a.answer.substring(0, 4)}}...</a></li>
	</ul>
</div>

<script>
	$.jStorage.set('user', <?php echo json_encode(User_Model::find_user($_SESSION['logged_user'])); ?>);
</script>