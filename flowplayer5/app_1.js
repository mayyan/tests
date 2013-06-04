// run script after document is ready
$(document).ready(function () {
    var videoAnalytics = {};

    /**
     * Resets the Analytics to zero
     * @returns {_L13.resetAnalyticsCuePoints}
     */
    function resetAnalyticsCuePoints() {
        videoAnalytics = {
            "25": false,
            "50": false,
            "75": false,
            "100": false
        };
    }

    function initializeVideoAnalytics() {
        flowplayer(function(api, root) {
            // when a new video's metadata is ready
            api.bind('ready', function () {
                fireVideoEvent('ready', api);
                resetAnalyticsCuePoints();
            }).bind('pause', function () {
                fireVideoEvent('pause', api);
            }).bind('mute', function(){
                fireVideoEvent('mute', api);
            }).bind('progress', function(){
                processProgress(api);
            }).bind('resume', function(){
                if(api.video.time < 0.3) {
                    fireVideoEvent('play', api)
                    resetAnalyticsCuePoints();
                } else {
                    fireVideoEvent('resume', api);
                }
            });
        });
    }
    /**
     * Precesses the progress of the play.
     * Triggers are 1/4 increments
     * @param {type} api
     * @returns {unresolved}
     */
    function processProgress(api) {
        var cuePoints = [25, 50, 75, 100];

        for(var i = 0; i < cuePoints.length; i++) {
            var currentCuePoint = cuePoints[i];
            if((api.video.time > api.video.duration * ((currentCuePoint - 5)/100))
                    && !videoAnalytics[currentCuePoint]) {
                fireVideoEvent('progress', api, currentCuePoint + "%" );
                videoAnalytics[currentCuePoint] = true;
            }

        }
    }

    /**
     * For analytics purposes fires the appropriate event
     * @param {type} event
     * @param {type} api
     * @param {integer} progressPercent
     */
    function fireVideoEvent(event, api, progressPercent) {
        console.log("fireVideoEvent " + event);
        $(document).trigger('couponsinc:video',{
            video: api.video.src.split('/').pop(),  /* get the filename of the video */
            event: event,
            timePlayed: api.video.time,
            totalTime: api.video.duration,
            progress: (typeof progressPercent !== 'undefined') ? progressPercent : ''
        });
    }

    function setupCarousel() {
        $(".prev, .next").click(function(event) {
            var target = $(event.currentTarget),
                curr = $(".fp-playlist .carousel-curr"),
                newItem,
                sign;

            if (target.hasClass("next")) {
                newItem = curr.next();
                sign = "-";
            } else {
                newItem = curr.prev();
                sign = "+";
            }

            if (newItem.length > 0) {
                curr.removeClass("carousel-curr");
                newItem.addClass("carousel-curr");
                $(".fp-playlist").animate({
                    marginLeft: sign + "=140px"
                }, 500);
            }
        });

    }

    function initVideoPlayer(playerElement) {
        initializeVideoAnalytics();

        
        playerElement.flowplayer({
            ratio: 0.8,
            embed: false
        });


    }

    function createVideo() {
        var html = $(".video-placeholder").html();
        // load script on demand
        $.getScript('flowplayer.js', function () {
            //
            $(".video-placeholder").html(html);

            // install flowplayer to an element with CSS class "player"
            initVideoPlayer($(".player"));
            setupCarousel();
        });
    }

    createVideo();
});