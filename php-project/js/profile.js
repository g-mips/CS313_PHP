(function() {
    kacologoApp = angular.module('kacologo-profile', []);
    
    /**************************** Profile Page Controller ****************************/
    kacologoApp.controller('ProfileCtrl', function() {
        this.tab = 1;
        
        $scope.isTabSet = function(tab) {
           return tab === this.tab;
        }
        
        $scope.setTab = function(tab) {
            this.tab = tab;
        }
    });
    
    kacologoApp.directive('profileContent', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/profileContent.php'
        };
    });
})();