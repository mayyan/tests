define(["jquery"], function($) {
    $(document).ready(function () {
        $('.pod').click(function(e){
            $(this).addClass("clipped");
        });

        $('.pod .btn-unclip').click(function(e){
            e.stopPropagation();
            $(this).parents(".pod").removeClass("clipped");
        });
    });
});