AnswerHubApp.controller('UserAnswerController', ['$scope','$http', function($scope, $http) {
	$http.get('/users-json/answers').success(function(data) {
		$scope.answers = data;
	});
}]);