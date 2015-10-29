(function() {
    kacologoApp = angular.module('kacologo-home', []);
    
    /**************************** Home Page Controller ****************************/
    kacologoApp.controller('HomeCtrl', ['$http', '$sce', '$scope', function($http, $sce, $scope) {
        $scope.mainVideo = [];
        $scope.videoTitle = null;
        $scope.videos = [];

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
                        
                        // First video is the only playable one.
                        if (index === 0) {
                            $scope.mainVideo[index] = {id: index, info: [$sce.trustAsResourceUrl(videoThumbnailUrl), $sce.trustAsResourceUrl("https://www.youtube.com/embed/" + videoId)]};
                            $scope.videoTitle = item.snippet.title;
                        } else {
                            $scope.videos.push({id: index - 1, info: [$sce.trustAsResourceUrl(videoThumbnailUrl), $sce.trustAsResourceUrl("https://www.youtube.com/embed/" + videoId)]});
                        }

                        index += 1;
                    });
                }).error(function(data) {
                    console.log("SERVER ERROR");
                });
            }).error(function(data) {
                console.log("SERVER ERROR");
            });

        // GET kacologo's current Twitch information 
        $http.get("https://api.twitch.tv/kraken/channels/kacologo").success(function(data) {
            $scope.twitchTitle = data.status;
        }).error(function(data) {
            console.log("SERVER ERROR");
        });
        
        /**
         * changeMainVid
         *  params:
         *    id: (int) index of the videos to be swapped
         *  Swaps the video at index id with the mainVideo
         **/
        $scope.changeMainVid = function(id) {
            // Swaps the two videos
            var tempVid = $scope.videos[id];
            $scope.videos[id] = $scope.mainVideo[0];
            $scope.mainVideo[0] = tempVid;
            
            // Preserve videos' ids
            var tempId = $scope.mainVideo[0].id;
            $scope.mainVideo[0].id = $scope.videos[id].id;
            $scope.videos[id].id = tempId;
        };
    }]);
    
    /**************************** Home Content Directive ****************************/
    kacologoApp.directive('homeContent', function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'templates/homeContent.html'
        };
    });
})();