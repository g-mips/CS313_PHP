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
            controller: function($http) {
                this.tab = 1;
                this.nPassword = "";
                this.oPassword = "";
                this.rnPassword = "";

                this.isTabSet = function(checkTab) {
                   return this.tab === checkTab;
                }

                this.setTab = function(tabToSet) {
                    this.tab = tabToSet;
                }
                
                this.changePassword = function(username) {
                    var data = "oPassword=" + this.oPassword + "&nPassword=" + this.nPassword + "&rnPassword=" + this.rnPassword + "&username=" + username;
                    
                    $http({
                        method: 'POST',
                        url: '/php-project/templates/changePassword.php',
                        data: data,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).success(function (data, status, headers, config)
                        {

                        })
                        .error(function (data, status, headers, config)
                        {

                        });
                    
                    this.nPassword = "";
                    this.oPassword = "";
                    this.rnPassword = "";
                }
            },
            controllerAs: "profile"
        };
    });
})();