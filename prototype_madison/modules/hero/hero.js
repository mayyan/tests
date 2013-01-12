APP_COUPONSINC.hero = (function ($) {

    var body = $(".mod-hero");

    function handleClick(event) {
        var target = $(event.target),
            currPanel = $(".curr-panel", body),
            nextPanel = null,
            prevPanel = null;


        if (target.hasClass("next")) {
            nextPanel = currPanel.next().length > 0 ? currPanel.next() : $(".panel", body).first();

            currPanel.removeClass("curr-panel");

            nextPanel.addClass("curr-panel");

        } else if (target.hasClass("prev")) {
            prevPanel = currPanel.prev().length > 0 ? currPanel.prev() : $(".panel", body).last();

            currPanel.removeClass("curr-panel");

            prevPanel.addClass("curr-panel");
        }
    }

    function onReady() {
        body.click(handleClick);
    }

    return {
        onReady: onReady
    };
}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.hero.onReady();
});