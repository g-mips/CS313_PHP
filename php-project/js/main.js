(function() {
    var kacologoApp = angular.module('kacologoApp', ['kacologo-home', 'kacologo-videos', 'kacologo-forum', 'kacologo-contact',
                                                     'kacologo-signup', 'kacologo-login', 'kacologo-profile']);
    
    /**************************** Main Controller ****************************/
    kacologoApp.controller('MainCtrl', function() {
        this.page = null;
        
        /**
         * isPageSet
         * Parameters:
         *    currentPage: str, contains a string of a page
         **/
        this.isPageSet = function(currentPage) {
            return this.page === currentPage;
        };
    });    
    
    /**************************** Navigator Directive ****************************/
    kacologoApp.directive('navigator', function() {
        return {
            restrict: 'E',
            templateUrl: 'templates/navigator.php'
        };
    });

    /**************************** Footer Links Directive ****************************/
    kacologoApp.directive('footerLinks', function() {
        return {
            restrict: 'E',
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