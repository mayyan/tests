APP.gallery = (function($) {
    var skip = $('.pod').length, //Number of skipped row
    take = 15, //Increment at each load
    endReached = false,

    allPodsIDs = APP.contextData.gallery.allPodsIDs,
    podCache = APP.contextData.gallery.podCache,
    template = '<div class="pod">POD {i}</div>',

    body = $(".mod-gallery");

    function load(skip, take) {

        if (endReached) {
            return;
        }
        var podIds = allPodsIDs.slice(skip, skip + take);

        if (podIds.length > 0) {
            console.log("loading " + podIds.length + " more. " + skip + " - " + (skip + podIds.length));

            $.each(podIds, function(index, podId) {
                var html = template.replace('{i}', skip + index);

                $(html).appendTo('.pods');
            });
        } else {
            console.log("End reached");
            $(document).trigger("endReached");
        }
    }

    function fixGotoPosition() {
        var right = $(document).width() - body.offset().left - body.outerWidth(),
            bottom = 0;

        /*console.log("window.scrollTop = " + $(window).scrollTop() +
            ", window.height = " + $(window).height() +
            ", gallery offset.top = " + body.offset().top +
            ", gallery outerHeight = " + body.outerHeight());*/
        
        if ($(window).scrollTop() + $(window).height() > body.offset().top + body.outerHeight()) {
            bottom = ($(window).scrollTop() + $(window).height()) - (body.offset().top + body.outerHeight());
        }
        //console.log("gallery fixGotoPosition right = " + right + ", bottom = " + bottom);
        $(".goto-top")
            .css("right", right + "px")
            .css("bottom", bottom + "px");
    }

    $(document).bind("endReached", function(e) {
        endReached = true;
        $(".more").hide();
        //$("<div>That's all for now.</div>").appendTo(".pods");
    })

    $(".more").click(function(e) {
        load(skip, take);

        skip = skip + take;
    });

    $(".goto-top").click(function(e) {
        e.preventDefault();
        $(window).scrollTop(0);
    });

    $(window).scroll(function () {

        if ($(window).scrollTop() + $(window).height() > body.offset().top + body.outerHeight()) {
            load(skip, take);
            skip = skip + take;
        }
        fixGotoPosition();
        
    });

    $(window).resize(fixGotoPosition);

    $(document).ready(function() {
        fixGotoPosition();
    });
}(jQuery));

