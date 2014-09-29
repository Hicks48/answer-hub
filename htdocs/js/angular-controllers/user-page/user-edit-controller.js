AnswerHubApp.controller('UserEditController', ['$scope','$http', function($scope, $http) {
	$scope.user = $.jStorage.get('user');
	$scope.username = $scope.user.username;
	$scope.email = $scope.user.email;
	
	$scope.edit_user_info = function() {
		$.ajax({
			type: 'POST',
			url: '/users/edit/user-info',
			data: { username: $scope.username, email: $scope.email }
		}).done(function(){
			$scope.edit_user_message = 'User info updated!';
			$scope.$apply();
		});
	}
	
	$scope.edit_password = function() {
		$.ajax({
			type: 'POST',
			url: '/users/edit/password',
			data: { old_password: $scope.old_password, new_password: $scope.new_password, new_password_again: $scope.new_password_again }
		}).done(function(){
			$scope.edit_password_message = 'User password updated!';
			$scope.$apply();
		}).fail(function() {
			$scope.edit_password_fail_message = 'Password not updated!!';
			$scope.$apply();
		});
	}
	
	$scope.delete_user = function() {
		$.ajax({
			type: 'POST',
			url: 'users/delete'
		});
	}
	
}]);