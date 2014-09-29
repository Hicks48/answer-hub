
AnswerHubApp.controller('QuestionController', ['$scope','$http', function($scope, $http){

	var QUESTION_ID = $.jStorage.get('id');
	
	$http.get('/questions-json/' + QUESTION_ID).success(function(data){
		$scope.question = data;
	});

}]);