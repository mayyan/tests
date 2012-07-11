(function() {
    function insertAfter(referenceNode, newNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }

    var scripts = document.getElementsByTagName('script'),
        thisScriptTag = scripts[scripts.length - 1],
        ifrm = document.createElement("iframe"),
        dim = ci_cap_format.split("x"),
        //ifrmSrc = "http://vdevusvr06.corp.coupons.com/?pid=13903&nid=10&zid=xh20&bid={bid}"
        ifrmSrc = "http://vdevusvr06.corp.coupons.com/?pid=13953&zid=jl94&nid=10&bid={bid}"
            .replace(/{bid}/g, ci_cap_bid);


    ifrm.setAttribute("src", ifrmSrc);
    ifrm.setAttribute("frameborder", "0");
    ifrm.style.height = dim[0]+"px";
    ifrm.style.width = dim[1]+"px";

    insertAfter(thisScriptTag, ifrm);
}());