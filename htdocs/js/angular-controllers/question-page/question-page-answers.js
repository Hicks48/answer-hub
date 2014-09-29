AnswerHubApp.controller('QuestionAnswerController', ['$scope','$http', function($scope, $http) {
	
		$http.get('/questions-json/answers/' + $.jStorage.get('id')).success(function(data){
			$scope.answers = data;
		});
		
		$scope.send_answer = function(){			
			$.ajax({
				type: 'POST',
				url: '/answers/create',
				data: { question_id: $.jStorage.get('id'), answer: $scope.answer }
			});
		}

}]);