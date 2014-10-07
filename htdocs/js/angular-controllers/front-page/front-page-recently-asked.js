AnswerHubApp.controller('RecentlyAskedController', ['$scope','$http', function($scope, $http){
	$http.get('/questions-json').success(function(data){
		$scope.recent_questions = data.sort(function(a,b){ return new Date(b.time_asked.replace(" ", "T")) - new Date(a.time_asked.replace(" ", "T")) });
	});
}]);
