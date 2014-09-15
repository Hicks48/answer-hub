var AnswerHubApp = angular.module('AnswerHubApp',[]);

AnswerHubApp.controller('RecentlyAskedController', ['$scope','$http', function($scope, $http){
	$http.get('/questions-json').success(function(data){
		$scope.recent_questions = data;
	});
}]);
