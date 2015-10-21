(function() {
    kacologoApp = angular.module('kacologo-signup', []);
    
    /**************************** Signup Page Controller ****************************/
    kacologoApp.controller('SignupCtrl', ['$scope', function($scope) {
        $scope.username = "";
        $scope.password = "";
        $scope.email = "";
        
        var register = function() {
            
        };
    }]);
    
    kacologoApp.directive('signupContent', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/signupContent.php'
        };
    });
})();