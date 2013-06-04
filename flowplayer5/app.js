// run script after document is ready
$(document).ready(function () {
//    var videoAnalytics = {};
//
//    /**
//     * Resets the Analytics to zero
//     * @returns {_L13.resetAnalyticsCuePoints}
//     */
//    function resetAnalyticsCuePoints() {
//        videoAnalytics = {
//            "25": false,
//            "50": false,
//            "75": false,
//            "100": false
//        };
//    }
//
//    function initializeVideoAnalytics() {
//        flowplayer(function(api, root) {
//            // when a new video's metadata is ready
//            api.bind('ready', function () {
//                fireVideoEvent('ready', api);
//                resetAnalyticsCuePoints();
//            }).bind('pause', function () {
//                fireVideoEvent('pause', api);
//            }).bind('mute', function(){
//                fireVideoEvent('mute', api);
//            }).bind('progress', function(){
//                processProgress(api);
//            }).bind('resume', function(){
//                if(api.video.time < 0.3) {
//                    fireVideoEvent('play', api)
//                    resetAnalyticsCuePoints();
//                } else {
//                    fireVideoEvent('resume', api);
//                }
//            });
//        });
//    }
//    /**
//     * Precesses the progress of the play.
//     * Triggers are 1/4 increments
//     * @param {type} api
//     * @returns {unresolved}
//     */
//    function processProgress(api) {
//        var cuePoints = [25, 50, 75, 100];
//
//        for(var i = 0; i < cuePoints.length; i++) {
//            var currentCuePoint = cuePoints[i];
//            if((api.video.time > api.video.duration * ((currentCuePoint - 5)/100))
//                    && !videoAnalytics[currentCuePoint]) {
//                fireVideoEvent('progress', api, currentCuePoint + "%" );
//                videoAnalytics[currentCuePoint] = true;
//            }
//
//        }
//    }
//
//    /**
//     * For analytics purposes fires the appropriate event
//     * @param {type} event
//     * @param {type} api
//     * @param {integer} progressPercent
//     */
//    function fireVideoEvent(event, api, progressPercent) {
//        console.log("fireVideoEvent " + event);
//        $(document).trigger('couponsinc:video',{
//            video: api.video.src.split('/').pop(),  /* get the filename of the video */
//            event: event,
//            timePlayed: api.video.time,
//            totalTime: api.video.duration,
//            progress: (typeof progressPercent !== 'undefined') ? progressPercent : ''
//        });
//    }

//    $("<source>", {
//        type: "video/mp4",
//        src: "http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/small2.mp4"
//    }).appendTo(".player video");

    //initializeVideoAnalytics();
    flowplayer.conf.embed = false;

//    var splash = [
//        "http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/Screen-Shot-2013-04-18-at-10.12.35-PM.png",
//        "http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/PostcardImageGoodbyeSummerHelloFall1.png",
//        "http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/300x2406.jpg"
//    ]

    // install flowplayer to an element with CSS class "player"
    $(".player").flowplayer({
        ratio: 0.8/*,
        playlist: [
            [{mp4: 'http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/small2.mp4'}],
            [{mp4: 'http://stream.flowplayer.org/night1/640x360.mp4'}],
            [{mp4: 'http://stream.flowplayer.org/night5/640x360.mp4'}]
        ]*/
    });
//
//    $.each($(".fp-playlist a"), function(index, item) {
//        if (index === 0) {
//            $(item).addClass("carousel-curr");
//        }
//        $("<img>",{src: splash[index]})
//            .appendTo(item);
//    });

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
                marginLeft: sign + "=144px"
            }, 500);
        }
    });


});