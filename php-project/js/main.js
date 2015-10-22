(function() {
    var kacologoApp = angular.module('kacologoApp', ['kacologo-home', 'kacologo-videos', 'kacologo-forum', 'kacologo-contact',
                                                     'kacologo-signup', 'kacologo-login', 'kacologo-profile']);
    
    /**************************** Main Controller ****************************/
    kacologoApp.controller('MainCtrl', function() {
        this.page = null;
        $scope.pageTitle = "";
        $scope.pageCSS = "";
        
        this.setPage = function(pageToSet) {
            this.page = pageToSet;
            
            if (this.page === 'HOME') {
                $scope.pageTitle = "Kacologo";
                $scope.pageCSS = "home";
            } else if (this.page === '
        };
        
        /**
         * isPageSet
         * Parameters:
         *    currentPage: str, contains a string of a page
         **/
        this.isPageSet = function(currentPage) {
            return this.page === currentPage;
        };
    });    
    
    /**************************** Header Directive ****************************/
    kacologoApp.directive('header', function() {
        return {
            restrict: 'A',
            replace: true,
            templateUrl: 'templates/header.html'
        };
    });
    
    /**************************** Navigator Directive ****************************/
    kacologoApp.directive('navigator', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/navigator.php'
        };
    });

    /**************************** Footer Links Directive ****************************/
    kacologoApp.directive('footerLinks', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/footerLinks.html'
        }; 
    });
    
    /**************************** Content Directive ****************************/
    kacologoApp.directive('content', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/content.php'
        };
    });
})();