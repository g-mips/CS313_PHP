(function() {
    kacologoApp = angular.module('kacologo-addPost', []);
    
    /**************************** Add Post Page Controller ****************************/
    kacologoApp.controller('AddPostCtrl', ['$scope', '$http', '$log', function($scope, $http, $log) {
            
    }]);
    
    kacologoApp.directive('addPostContent', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/addPostContent.php'
        };
    });
})();