(function() {
    kacologoApp = angular.module('kacologo-contact', []);
    
    /**************************** Videos Page Controller ****************************/
    kacologoApp.controller('ContactCtrl', function() {
        
    });
    
    kacologoApp.directive('contactContent', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/contactContent.html'
        };
    });
})();