AnswerHubApp.controller('SearchController', ['$scope','$http', function($scope, $http){
	
	$scope.do_search = function(data) {
		$.ajax({
				type: 'POST',
				url: '/questions-json/search',
				data: { search_input: $scope.search_input }
			}).done(function(data){
				$scope.search_results = angular.fromJson(data);
				
				if($scope.search_results.length == 0) {
					$scope.results_message = "No question matches search.";
				}
				
				else {
					$scope.results_message = "Search Succesful.";
				}
				
				$scope.$apply();
			}).fail(function() {
				$scope.results_message = "Invalid search";
			});
	}
}]);