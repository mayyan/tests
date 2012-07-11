var Magnifier = function () {
    var hoverTimer = 0,
        goneTimer = 0;

    function clearTimers() {
        clearTimeout(hoverTimer);
        clearTimeout(goneTimer);
    }

    function onMouseEnter(event) {
        clearTimeout(goneTimer);
        
        var pod = $(this);
        //Hover for 1 sec to display
        hoverTimer = setTimeout(function () {
            onHover(pod);
        }, 1000);
    }

    function onMouseLeave(event) {
        clearTimeout(hoverTimer);

        //Gone for 1 sec to destroy
        goneTimer = setTimeout(function() {
            //$('.magnifier').dialog("destroy");
        }, 1000);
    }

    function onHover(pod) {
        var dest = '#effect-dest';

        setContent(pod);

        if ($('.magnifier-outer').length > 0) {
            dest = '.magnifier-outer';
        }

        pod.effect("transfer", {
            to: dest,
            className: 'effects-transfer'
        }, 750, function () {
            openMagnifier(pod);
        });
    }

    function openMagnifier(pod) {
        $('.magnifier')
            //.removeClass("hidden")
            .dialog({
                width: 600,
                //height: 274,
                //minHeight: 274,
                //autoOpen: false,
                dialogClass: 'magnifier-outer',
                title: 'Look at the fine print ...',
                /*open: function (event, ui) {
                    var $this = $(this);

                    $this
                        .dialog("widget")
                        .effect("transfer", {
                            to: '#effect-dest',
                            className: 'effects-transfer'
                        }, 750);
                    return true;
                },*/
                close: function (event, ui) {
                    $('.magnifier').dialog("destroy");
                },
                beforeClose: function () {
                    var $this = $(this);

                    $this
                        .dialog("widget")
                        .effect("transfer", {
                            to: pod,
                            className: 'effects-transfer'
                        }, 750);
                    return true;
                }
            });

        clearTimers();
    }

    function setContent(pod) {
        $('.magnifier').empty();
        pod.clone().appendTo('.magnifier');

        $('.magnifier .pod').removeAttr("id");
        $('.magnifier .pod .fine-print').removeClass("hidden");
        $('.magnifier .pod input').attr('disabled', true);
        $('.magnifier .pod .pod-image')
            .attr('width', 160)
            .attr('height', 200);
    }
    
    function init() {
        $(".pod").mouseenter(onMouseEnter);
        $(".pod").mouseleave(onMouseLeave);
        $(".magnifier-outer").live('mouseenter', clearTimers);
    }

    $(document).ready(function() {
        init();
    });
}();

