AnswerHubApp.controller('QuestionEditController', ['$scope','$http', function($scope, $http) {
	var QUESTION_ID = $.jStorage.get('id');

	$http.get('/questions-json/' + QUESTION_ID).success(function(data) {
		$scope.question = data;
	});
	
	$http.get('/questions-json/tags/' + QUESTION_ID).success(function(data) {
		var tags_string = "";
		
		data.forEach(function(data){
			tags_string = tags_string + " " + tag.name;
		});
		
		tags_string = tags_string.trim();
		tags_string = tags_string.replace(" ", ", ");
		
		$scope.tags = tags_string;
	});
}]);