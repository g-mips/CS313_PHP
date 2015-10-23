(function() {
    kacologoApp = angular.module('kacologo-profile', []);
    
    /**************************** Profile Page Controller ****************************/
    kacologoApp.controller('ProfileCtrl', ['$scope', function($scope) {
        this.tab = 1;
        
        $scope.isTabSet = function(checkTab) {
           return this.tab === checkTab;
        }
        
        $scope.setTab = function(tabToSet) {
            this.tab = tabToSet;
        }
    }]);
    
    kacologoApp.directive('profileContent', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/profileContent.php',
            controller: function($scope) {
                this.tab = 1;

                $scope.isTabSet = function(checkTab) {
                   return this.tab === checkTab;
                }

                $scope.setTab = function(tabToSet) {
                    this.tab = tabToSet;
                }
            },
            controllerAs: "profile"
        };
    });
})();