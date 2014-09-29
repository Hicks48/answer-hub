AnswerHubApp.controller('AllQuestionsController', ['$scope','$http', function($scope, $http){
	$http.get('/questions-json').success(function(data){
		$scope.questions = data;
	});
}]);