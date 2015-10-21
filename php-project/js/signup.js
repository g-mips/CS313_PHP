(function() {
    kacologoApp = angular.module('kacologo-signup', []);
    
    /**************************** Signup Page Controller ****************************/
    kacologoApp.controller('SignupCtrl', ['$scope', '$http', function($scope, $http) {
        $scope.username = "";
        $scope.password = "";
        $scope.email = "";
        
        $scope.register = function() {
            var config = {
                params: {
                    username: $scope.username,
                    password: $scope.password,
                    email: $scope.email
                }
            };
            
            $http.post("/php-project/templates/register.php", null, config)
                .success(function (data, status, headers, config)
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