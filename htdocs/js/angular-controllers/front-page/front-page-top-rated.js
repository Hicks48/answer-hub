AnswerHubApp.controller('TopRatedController', ['$scope','$http', function($scope, $http){
	$http.get('/questions-json/top-rated').success(function(data){
		$scope.top_rated_questions = data.sort(function(a,b){ return b.rating - a.rating });
	});
}]);