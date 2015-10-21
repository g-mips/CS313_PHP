(function() {
    kacologoApp = angular.module('kacologo-signup', []);
    
    /**************************** Signup Page Controller ****************************/
    kacologoApp.controller('SignupCtrl', function() {
        var register = function() {
            
        };
    });
    
    kacologoApp.directive('signupContent', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/signupContent.php'
        };
    });
})();