(function () {
    function unifyRowHeight() {
        if (window.matchMedia('screen and (min-width: 768px)').matches) {
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

    function positionNevbar() {
        var body = $("body"),
            navbar = $(".mod-navbar");

        if (window.matchMedia('only screen and (min-width : 321px)').matches) {
            // Smartphones (landscape)
            // screen is too short to show the whole expanded nav, 
            // so better not to fixed to top
            navbar.removeClass("navbar-fixed-top"). addClass("navbar-static-top");
            body.css("padding-top", 0);
        } else {
            navbar.removeClass("navbar-static-top"). addClass("navbar-fixed-top");
            body.css("padding-top", "70px");
        }
    }

    $(document).ready(function () {
        $("#goto-top").click(function (e) {
            e.preventDefault();
            $(window).scrollTop(0);
        });

        $('.mod-hero .carousel').carousel();

        $('.couponcart').popover({
            html: true,
            placement: "top",
            trigger: 'click',
            container: '.bottom-nav .nav',
            title: "My Savings",
            content: '<div class="progress progress-striped active">' +
                    '<div class="bar" style="width: 50%;">$15.35</div>' +
                    '<span class="bold pull-right muted">$300</span>' +
                    '</div>'
        });

        $('.btn-search').popover({
            html: true,
            placement: "top",
            trigger: 'click',
            container: '.bottom-nav .nav',
            content: '<form class="form-search">' +
                        '<div class="input-append">' +
                            '<input class="span2" id="appendedInput" type="text" placeholder="Search ...">' +
                            '<span class="add-on"><i class="icon-search"></i></span>' +
                        '</div>' +
                    '</form>'
        });

        $('.pod').click(function(e){
            $(this).addClass("clipped");
        });

        $('.pod .btn-unclip').click(function(e){
            e.stopPropagation();
            $(this).parents(".pod").removeClass("clipped");
        });
    
    });

    $(window).resize(function () {
        positionNevbar();
        unifyRowHeight();
    });

    $(window).load(function () {
        positionNevbar();
        unifyRowHeight();
    });
}());
