AnswerHubApp.controller('UserQuestionController', ['$scope','$http', function($scope, $http) {
	$http.get('/users-json/questions').success(function(data) {
		console.log(data);
		$scope.questions = data;
	});
}]);