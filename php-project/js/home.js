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
                console.log(data.items[0]);
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
                        console.log(item);
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
                    console.log("ERROR");
                });
            }).error(function(data) {
                console.log("ERROR");
            });

        // GET kacologo's current Twitch information 
        $http.get("https://api.twitch.tv/kraken/channels/kacologo").success(function(data) {
            console.log(data);
            $scope.twitchTitle = data.status;
        }).error(function(data) {
            console.log("ERROR");
        });
        
        $scope.changeMainVid = function(id) {
            console.log("INDEX: " + id);
            console.log("VID ID: " + $scope.videos[id].id);
            console.log("VID IN: " + $scope.videos[id].info);
            var tempVid = $scope.videos[id];
            console.log("TEM ID: " + tempVid.id);
            console.log("VID IN: " + tempVid.info);
            $scope.videos[id] = $scope.mainVideo[0];
            console.log("NEW VID ID: " + $scope.videos[id].id);
            console.log("NEW VID IN: " + $scope.videos[id].info);
            console.log("MAN ID: " + $scope.mainVideo[0].id);
            console.log("MAN IN: " + $scope.mainVideo[0].info);
            $scope.mainVideo[0] = tempVid;
            console.log("NEW MAN ID: " + $scope.mainVideo[0].id);
            console.log("NEW MAN IN: " + $scope.mainVideo[0].info);
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