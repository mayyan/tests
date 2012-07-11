$(document).ready(function () {
    var skip = $('.pod').length, //Number of skipped row
        take = 15, //Increment at each load
        endReached = false,

        allPodsIDs = contextData.gallery.allPodsIDs,
        podCache = contextData.gallery.podCache,
        template = '<div class="pod">POD {i}</div>',

        fixedBlockSelectors = ["#rail"],
        fixedPositions = {};

    function savePosition() {
        $.each(fixedBlockSelectors, function(index, selector) {
            fixedPositions[selector] = $(selector).offset();

            var marginLeft = parseInt($(selector).css("margin-left"), 10),
                marginTop = parseInt($(selector).css("margin-top"), 10);

            $(selector)
                .css("left", (fixedPositions[selector].left - marginLeft) + "px")
                .css("top", (fixedPositions[selector].top - marginTop) + "px");
        });
    }

    function fixPosition() {
        var y = $(window).scrollTop();
        if (y > 0) {
            $.each(fixedBlockSelectors, function(index, selector) {
                //console.log(selector + ":" + fixedPositions[selector].left + " " + fixedPositions[selector].top);
                //console.log("window.scrollTop=" + y + ", " + selector + " original top=" + fixedPositions[selector].top);

                $(selector).addClass('fixed');
            });
        } else {
            $.each(fixedBlockSelectors, function(index, selector) {
                $(selector).removeClass('fixed');
            });
        }
    }

    function showOrHideMoreButton() {
        if ($('.pods').height() < $('.pods')[0].scrollHeight) {
            $(".more").hide();
        } else {
            $(".more").show();
        }
    }

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

        /*if ($('.pods').height() < $('.pods')[0].scrollHeight) {
            $(".more").hide();
        }*/
    }



    $(document).bind("endReached", function(e) {
        endReached = true;
        $(".more").hide();
        $("<div>That's all for now. More coming soon.</div>").appendTo(".pods");
    })

    $(".more").click(function(e) {
        load(skip, take);

        skip = skip + take;
    });

    $(".goto-top").click(function(e) {
        e.preventDefault();

        /*$('.pods').scrollTop(0);*/
        $(window).scrollTop(0);
    });



    $(window).scroll(function () {

        if ($(window).scrollTop() + $(window).height() - $(document).height() == 0) {
            load(skip, take);
            skip = skip + take;
        }

        //fixPosition();
    });

    $(window).resize(function() {

    });

    /*$('.pods').scroll(function () {

        if ($('.pods').scrollTop() + $('.pods').height() - $('.pods')[0].scrollHeight == 0) {
            load(skip, take);
            skip = skip + take;
        }
    });*/

    console.log("Total " + allPodsIDs.length);
    //showOrHideMoreButton();
    //savePosition();
});