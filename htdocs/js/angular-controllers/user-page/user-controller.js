AnswerHubApp.controller('UserController', ['$scope','$http', function($scope, $http) {
	$scope.user = $.jStorage.get('user');
}]);