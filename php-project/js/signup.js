(function() {
    kacologoApp = angular.module('kacologo-signup', []);
    
    /**************************** Signup Page Controller ****************************/
    kacologoApp.controller('SignupCtrl', ['$scope', '$http', function($scope, $http) {
        $scope.username = "";
        $scope.password = "";
        $scope.email = "";
        
        $scope.register = function() {
            log.console("INSIDE REGISTER");
            var config = {
                params: {
                    username: $scope.username,
                    password: $scope.password,
                    email: $scope.email
                }
            };
            $http.post("register.php", null, config)
                .success(function (data, status, headers, config)
                {
                  $scope["submissionResult"] = data;
                })
                .error(function (data, status, headers, config)
                {
                  $scope["submissionResult"] = "<h1>Server Error!</h1>";
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