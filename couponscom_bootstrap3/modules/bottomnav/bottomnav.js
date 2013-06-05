(function () {
    $(document).ready(function () {
        $("#goto-top").click(function (e) {
            e.preventDefault();
            $(window).scrollTop(0);
        });

        $('.couponcart').popover({
            html: true,
            placement: "top",
            trigger: 'click',
            container: '.mod-bottom-nav',
            title: "My Savings",
            content: '<div class="progress progress-striped active">' +
                    '<div class="bar" style="width: 50%;">$15.35</div>' +
                    '<span class="bold pull-right muted">$300</span>' +
                    '</div>'
        });
    
    });
}());
