AnswerHubApp.controller('TopRatedController', ['$scope','$http', function($scope, $http){
	$http.get('/questions-json').success(function(data){
		$scope.top_rated_questions = data;
	});
}]);