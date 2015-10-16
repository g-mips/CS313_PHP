(function() {
    kacologoApp = angular.module('kacologo-videos', ['kacologoApp']);
    
    /**************************** Videos Page Controller ****************************/
    kacologoApp.controller('VideosCtrl', function() {
        
    });
    
    kacologoApp.directive('videosContent', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/videosContent.html'
        };
    });
})();