(function() {
    kacologoApp = angular.module('kacologo-forum', []);
    
    /**************************** Forum Page Controller ****************************/
    kacologoApp.controller('ForumCtrl', ['$scope', '$http', '$log', function($scope, $http, $log) {
        $scope.isReplying = false;
        this.content = "";
        
        $scope.setReply = function(value) {
            $scope.isReplying = value;
        }
        
        $scope.sendPost = function() {
            var data = "content=" + this.content;
            
            $log.log("CONTENT: " + this.content);
            $log.log("DATA: " + data);
            
            $http({
                method: 'POST',
                url: '/php-project/templates/addThreadOrPost.php',
                data: data,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data, status, headers, config)
                       {
                data = data.replace('\r', '').replace('\n', '').trim();
                if (data == 'SUCCESS') {
                    window.location = 'http://php-gshawm.rhcloud.com/php-project/forum.php';
                } else {
                    $scope["submissionResult"] = data;
                }
            })
            .error(function (data, status, headers, config)
                   {
                $scope["submissionResult"] = "Server Error!";
            });
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