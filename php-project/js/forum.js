(function() {
    kacologoApp = angular.module('kacologo-forum', []);
    
    /**************************** Forum Page Controller ****************************/
    kacologoApp.controller('ForumCtrl', ['$scope', function($scope) {
        $scope.isReplying = false;
        
        $scope.setReply = function() {
            $scope.isReplying = true;
        };
    }]);
    
    kacologoApp.directive('forumContent', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/forumContent.php'
        };
    });
})();