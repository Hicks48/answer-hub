AnswerHubApp.controller('QuestionAnswerController', ['$scope','$http', function($scope, $http) {
	
		$http.get('/questions-json/answers/' + $.jStorage.get('id')).success(function(data){
			$scope.answers = data;
		});
		
		$scope.send_answer = function(){			
			$.ajax({
				type: 'POST',
				url: '/answers/create',
				data: { question_id: $.jStorage.get('id'), answer: $scope.answer }
			}).done(function(){
				$scope.create_answer_message = "Answer succesfully created!";
				$http.get('/questions-json/answers/' + $.jStorage.get('id')).success(function(data){
					$scope.answers = data;
				});
				$scope.create_answer_fail_message = "";
				$scope.$apply();
			}).fail(function(){
				$scope.create_answer_message = "";
				$scope.create_answer_fail_message = "Creating answer failed!";
				$scope.$apply();
			});
		}

}]);