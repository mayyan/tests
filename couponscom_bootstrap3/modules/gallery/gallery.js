define(["jquery"], function($) {
    function unifyRowHeight() {
    	if (Modernizr.mq('screen and (min-width: 768px)')) {
            var rows = $(".dyn-row-height");

            $.each(rows, function (rowIndex, row) {
                var podHeight = 0,
                    podsInRow = $(".pod", $(row));

                $.each(podsInRow, function (podIndex, pod) {
                    $(pod).css("height", "auto");
                });

                $.each(podsInRow, function (podIndex, pod) {
                    var height = $(pod).outerHeight();
                    if (height > podHeight) {
                        podHeight = height;
                    }
                });

                $.each(podsInRow, function (podIndex, pod) {
                    $(pod).css("height", (podHeight + 30) + "px"); //30px is height of clipped-views
                });

            });
        } else {
            $(".pod").css("height", "auto");
        }
    }

	$(window).resize(function () {
        unifyRowHeight();
    });

    $(window).load(function () {
        unifyRowHeight();
    });
});