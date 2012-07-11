var LIB_BUBBLE = {
    data : {
        "pageload": {
            "name": "New Nav Bar",
            "url": "http://localhost/",
            "triggered_by": "pageload",
            "triggers": "New Nav Bar|Close",
            
            "content": "Notice this on page load?",
            "element_id": "test-div",
            "style" : "triangle-isosceles top"
        },
        "hover" : {
            "name": "New Nav Bar",
            "url": "http://localhost/",
            "triggered_by": "hover",
            "triggers": "New Nav Bar|Close",

            "content": "Thank you for finding this.",
            "element_id": "test-hover",
            "style" : "triangle-isosceles top"
        }
    },

    getOffset : function (o){
        for(var r = {x: o.offsetLeft, y: o.offsetTop, h: o.offsetHeight, w: o.offsetWidth}; o = o.offsetParent; r.x += o.offsetLeft, r.y += o.offsetTop);
        return r;
    },

    loadCSS : function () {
        var head = document.getElementsByTagName("head")[0],
            css = document.createElement("link");

        css.rel = "stylesheet";
        css.type = "text/css";
        css.href = "bubble.css";

        head.appendChild(css);
    },

    init : function (data) {
        var elemId = data['element_id'],
            elem = document.getElementById(elemId),
            offset = LIB_BUBBLE.getOffset(elem),
            bubble,
            content = data['content'],
            style = data['style'];

        bubble = document.createElement("div");
        bubble.id = 'bubble-' + data['element_id'];
        document.body.appendChild(bubble);

        bubble.innerHTML = content;
        bubble.className = bubble.className + " " + style;

        bubble.style.position = "absolute";
        bubble.style.left= offset.x + "px";
        bubble.style.top = offset.y + elem.offsetHeight + "px";
    },

    attachEvent : function (elem, evt, fnc) {
        if (elem.addEventListener){
            elem.addEventListener(evt, fnc, false);
            return true;
        } else if (elem.attachEvent) {
            return elem.attachEvent("on"+evt,fnc);
        }
    },
    

    close : function () {

    }
};

window.onload = function() {
    var data,
        elem;
        
    LIB_BUBBLE.loadCSS();

    if (LIB_BUBBLE['data']['pageload']) {
        data = LIB_BUBBLE['data']['pageload'];
        LIB_BUBBLE.init(data);
    }

    if (LIB_BUBBLE['data']['hover']) {
        data = LIB_BUBBLE['data']['hover'];
        elem  = document.getElementById(data['element_id']);

        LIB_BUBBLE.attachEvent(elem, 'mouseover', function(){
            LIB_BUBBLE.init(data);
        });
    }
}


