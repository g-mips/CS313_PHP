(function() {
    kacologoApp = angular.module('kacologo-videos', []);
    
    /**************************** Videos Page Controller ****************************/
    kacologoApp.controller('VideosCtrl', ['$scope', '$http', function($scope, $http) {
        $scope.videos = null;
        
        // GET kacologo's youtube channel 
        $http.get("https://www.googleapis.com/youtube/v3/channels", {
            params: {
                part: 'contentDetails',
                forUsername: 'kacologo',
                key: 'AIzaSyBl5kaMOcxag58h_TT7VfHcO29NJIDM_EU' }
            }).success(function(data) {
                var pid = data.items[0].contentDetails.relatedPlaylists.uploads;

                // GET kacologo's youtube uploads
                $http.get("https://www.googleapis.com/youtube/v3/playlistItems", {
                    params: {
                        part: 'snippet',
                        maxResults: 4,
                        playlistId: pid,
                        key: 'AIzaSyBl5kaMOcxag58h_TT7VfHcO29NJIDM_EU' }
                    }).success(function(data) {
                    var index = 0;

                    // Cycle through videos
                    $.each(data.items, function(i, item) {
                        var videoId = item.snippet.resourceId.videoId;
                        var videoThumbnailUrl = item.snippet.thumbnails.high.url;
                        
                        $scope.videos.push({thumb: $sce.trustAsResourceUrl(videoThumbnailUrl),
                                            link: $sce.trustAsResourceUrl("https://www.youtube.com/embed/" + videoId)});
                        index += 1;
                    });
                }).error(function(data) {
                    console.log("SERVER ERROR");
                });
            }).error(function(data) {
                console.log("SERVER ERROR");
            });
    }]);
    
    kacologoApp.directive('videosContent', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/videosContent.html'
        };
    });
})();