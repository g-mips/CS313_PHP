(function() {
    kacologoApp = angular.module('kacologo-addThread', []);
    
    /**************************** Add Post Page Controller ****************************/
    kacologoApp.controller('AddThreadCtrl', ['$scope', '$http', '$log', function($scope, $http, $log) {
        $scope.subject = "";
        $scope.content = "";
        
        /**
         * addThread
         *    Calls addThreadOrPost.php with a POST and if was successful, goes back to forum.
         **/
        $scope.addThread = function() {
            var data = "subject=" + $scope.subject + "&content=" + $scope.content;
            
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
    
    kacologoApp.directive('addThreadContent', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/addThreadContent.php'
        };
    });
})();