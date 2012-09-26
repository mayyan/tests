(function($) {
    $(window).load(onLoad);

    var podTemplate = $(".pod-template").html(),
        podCache,
        socket;

    function onLoad() {
        $("#stopBtn").click(handleStop);
        getPodCache();
        openSocket();
    }

    function handleStop() {
        socket.close();
    }

    function createPod(podId) {
        if (podCache[podId]) {
            var podData = podCache[podId],

                img = '<img class="pod-image" src="{imageUrl}" width="80" height="100">'
                    .replace("{imageUrl}", podData.image.url),

                podHtml = podTemplate
                    .replace("{podId}", podId)
                    .replace("{imageTag}", img)
                    .replace("{summary}", podData.summary)
                    .replace("{brand}", podData.brand)
                    .replace("{details}", podData.details),

                pod = $(podHtml)
                    .appendTo("body");

            return pod;
        } else {
            return null;
        }
    }

    function animatePods(pods) {
        $.each(pods, function(index, pod){
            var delay = (index * 0.1) + "s";
            animatePod(pod, delay);
        });
    }

    function animatePod(pod, delay) {
        var windowWidth = $(window).width(),
            windowHeight = $(window).height(),
            podHeight = pod.outerHeight(),
            podWidth = pod.outerWidth(),
            travelHeight = windowHeight - podHeight,
            stratingX = Math.random() * (windowWidth - podWidth),
            translateTempalte = "translate({x}px, {y}px)",
            translate = '';

        translate = translateTempalte
            .replace("{x}", stratingX)
            .replace("{y}", travelHeight);

        pod.bind('webkitTransitionEnd',
            function(event) {
                $(this).remove();
            }
        );

        pod.css("-webkit-transform", translate)
            .css("-webkit-transition-delay", delay)
            .addClass("falling");
    }

    function handleSocketMessage(event) {
        var data = JSON.parse(event.data),
            podIds = data.cids.split(","),
            pods = [];

        $.each(podIds, function(index, podId){
            var pod = createPod(podId);

            if (pod) {
                pods.push(pod);
            }
        });
        animatePods(pods);


    }

    function getPodCache() {
        $.ajax({
            url: "http://vdevusvr06.corp.coupons.com/ajax/allpods", // this service is on branch CPN-3786
            dataType: 'json',
            success: handleGetPodCacheSuccess,
            error: handleGetPodCacheError
        });
    }

    function handleGetPodCacheSuccess(data) {
        podCache = data.gallery.podCache;
    }

    function handleGetPodCacheError(jqXHR, textStatus, errorThrown) {
        //alert("handleGetPodCacheError: " + errorThrown);
        // fallback to fake response
        podCache = fakeResp.gallery.podCache;
    }

    function openSocket() {
        socket = new WebSocket("ws://vdevusvr01.corp.coupons.com:8000/printFeed");
        socket.onmessage = handleSocketMessage;
    }
}(jQuery));
