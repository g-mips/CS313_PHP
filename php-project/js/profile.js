(function() {
    kacologoApp = angular.module('kacologo-profile', []);
    
    /**************************** Profile Page Controller ****************************/
    kacologoApp.controller('profileCtrl', function() {
       
    });
    
    kacologoApp.directive('profileContent', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/profileContent.php'
        };
    });
})();