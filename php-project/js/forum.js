(function() {
    kacologoApp = angular.module('kacologo-forum', ['kacologoApp']);
    
    /**************************** Videos Page Controller ****************************/
    kacologoApp.controller('ForumCtrl', function() {
        
    });
    
    kacologoApp.directive('forumContent', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/forumContent.html'
        };
    });
})();