(function() {
    kacologoApp = angular.module('kacologo-profile', []);
    
    /**************************** Profile Page Controller ****************************/
    kacologoApp.controller('ProfileCtrl', function() {
       
    });
    
    kacologoApp.directive('profileContent', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/profileContent.php'
        };
    });
})();