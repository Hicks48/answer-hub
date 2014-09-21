AnswerHubApp.controller('QuestionAnswerController', ['$scope','$http', function($scope, $http){
	
		$http.get('/questions-json/' + QUESTION_ID).success(function(data){
			$scope.question = data;
		});

}]);