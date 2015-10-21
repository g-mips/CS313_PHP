(function() {
    kacologoApp = angular.module('kacologo-signup', []);
    
    /**************************** Signup Page Controller ****************************/
    kacologoApp.controller('SignupCtrl', ['$scope', '$http', function($scope, $http) {
        $scope.username = "";
        $scope.password = "";
        $scope.email = "";
        
        $scope.register = function() {
            var data = "username=" . $scope.username . "&password=" . $scope.password . "&email=" . $scope.email;
            
            $http({
                method: 'POST',
                url: '/php-project/templates/register.php',
                data: data,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data, status, headers, config)
                {
                  $scope["submissionResult"] = data;
                })
                .error(function (data, status, headers, config)
                {
                  $scope["submissionResult"] = "Server Error!";
                });
            
            $scope.username = "";
            $scope.password = "";
            $scope.email = "";
        };
    }]);
    
    kacologoApp.directive('signupContent', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/signupContent.php'
        };
    });
})();