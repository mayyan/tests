Array.prototype.contains = function (x) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == x) return true;
    }
    return false;
}
String.prototype.ci_capp_trim = function () {
    return this.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1");
};
String.prototype.ci_capp_removeDoubleQuotes = function () {
    return this.replace(/"/g, "");
};
String.prototype.ci_capp_getDomain = function () {
    var dm = this;
    if (dm.indexOf("//") > -1) {
        dm = dm.substring(dm.indexOf("//") + 2);
    }
    if (dm.indexOf("www.") == 0) {
        dm = dm.substring(4);
    }
    return (dm.lastIndexOf("/") > -1 ? dm.substring(0, dm.lastIndexOf("/")) : dm);
}
String.prototype.ci_capp_getUrl = function () {
    var url = this;
    if (url.indexOf("?") > -1) {
        url = url.substring(0, url.indexOf("?"));
    }
    return url;
}
String.prototype.ci_capp_getNumericValue = function () {
    if (this == null) return 0;
    var numVal = "";
    for (var i = 0; i < this.length; i++) {
        if ((numVal.length == 0 && this.charAt(i) == '-') || (this.charAt(i) >= '0' && this.charAt(i) <= '9')) {
            numVal += this.charAt(i);
        }
    }
    return numVal;
}
var ci_capf_keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZ" + "abcdefghijklmnopqrstuvwxyz" + "0123456789+/=";

function ci_capf_decode64(inp) {
    if (inp.length == 0) return "";
    var out = "";
    var chr1, chr2, chr3 = "";
    var enc1, enc2, enc3, enc4 = "";
    var i = 0;
    var base64test = /[^A-Za-z0-9\+\/\=]/g;
    if (base64test.exec(inp)) {
        return "";
    }
    inp = inp.replace(/[^A-Za-z0-9\+\/\=]/g, "");
    do {
        enc1 = ci_capf_keyStr.indexOf(inp.charAt(i++));
        enc2 = ci_capf_keyStr.indexOf(inp.charAt(i++));
        enc3 = ci_capf_keyStr.indexOf(inp.charAt(i++));
        enc4 = ci_capf_keyStr.indexOf(inp.charAt(i++));
        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;
        out = out + String.fromCharCode(chr1);
        if (enc3 != 64) {
            out = out + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
            out = out + String.fromCharCode(chr3);
        }
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
    } while (i < inp.length);
    return out;
}

var ci_ssl = "http";
var ci_imgZipCodeUrl = "";
var ci_tokQuery = "";
var ci_altBannerTimeout = 12000;
var ci_altGalleryTimeout = 30000;
var ci_CAPTrackUrlBase = "http://bcstsupport.coupons.com/UpdateStatus.ashx";
var ci_baseDeviceJS = "http://cdn.cpnscdn.com/bc.coupons.com/assets_CouponClick/_include/BaseDevice_v23.js";
var ci_zipCodeTimeout = 3000;
// =================================================
var ci_cap_clickImageUrl = "http://cdn.cpnscdn.com/bc.coupons.com/assets_CouponClick/_images/";
var ci_cap_clickUrl = "http://bc.coupons.com/";
var ci_cap_couponsUrl = "http://www.coupons.com/couponweb/index.aspx?pid=13903&nid=10&zid=xh20&cid=0&bid=";
var ci_cap_privacyUrl = "http://www.couponsinc.com/Corporate/Privacy.aspx";
var ci_cap_termsOfUse = "http://www.couponsinc.com/Corporate/Terms.aspx";
var ci_cap_helpUrl = "http://print.coupons.com/couponweb/help/print/index.html";
var ci_cap_trGuide = "http://bricks.coupons.com/help/InstallGuide.asp";
var ci_cap_altAdCode = "";
var ci_cap_deviceBypass = "1";
var ci_cap_mac = "AMUAAREKS";
var ci_cap_theme_version_key = "_v8"
var ci_cap_couponsSorted = false;
var ci_cap_dashBoardCouponsSorted = false;


// =================================================
function ci_capf_Device_MacFireFox(id, stp, btyp, sid, bid, chn, acstm, otlbckg, allcpnsimg, allcpnsdisabledimg, scrollcpnsimg, bycpnsimg, qprtimgwinnt, qprtimg, cpcimgwinnt, cpcimg, osumtxtfnt, btxtfnt, otxtfnt, patxtfnt, acpnstxt, acpnsfnt, scrlcpnstxt, scrrcpnstxt, scrcpnsfnt, bycpnstxt, bycpnsfnt, prttrackurl, cpnswebredirtrackurl, fmtX, fmtY, altCode, brdColor, bckColor, osumColor, btxtColor, otxtColor, prtActColor) {
    if (typeof (ci_capf_Device) == "undefined") {

        var ci_cap_conStrtemp = '(' + id + ',' + stp + ',' + btyp + ',"' + sid + '"' + ',"' + bid + '"' + ',' + (chn != null ? '"' + chn + '"' : 'null') + ',"' + acstm + '"' + ',"' + otlbckg + '"' + ',"' + allcpnsimg + '"' + ',"' + allcpnsdisabledimg + '"' + ',"' + scrollcpnsimg + '"' + ',"' + bycpnsimg + '"' + ',"' + qprtimgwinnt + '"' + ',"' + qprtimg + '"' + ',"' + cpcimgwinnt + '"' + ',"' + cpcimg + '"' + ',"' + osumtxtfnt + '"' + ',"' + btxtfnt + '"' + ',"' + otxtfnt + '"' + ',"' + patxtfnt + '"' + ',"' + acpnstxt + '"' + ',"' + acpnsfnt + '"' + ',"' + scrlcpnstxt + '"' + ',"' + scrrcpnstxt + '"' + ',"' + scrcpnsfnt + '"' + ',"' + bycpnstxt + '"' + ',"' + bycpnsfnt + '"' + ',"' + prttrackurl + '"' + ',"' + cpnswebredirtrackurl + '"' + ',"' + fmtX + '","' + fmtY + '","' + altCode + '"' + ',"' + brdColor + '"' + ',"' + bckColor + '"' + ',"' + osumColor + '"' + ',"' + btxtColor + '"' + ',"' + otxtColor + '"' + ',"' + prtActColor + '"' + ');';

        setTimeout("ci_capf_Device_" + id + " = new ci_capf_Device_MacFireFox" + ci_cap_conStrtemp, 10);
        return;
    }

    ci_capf_Device.call(this, id, stp, btyp, sid, bid, chn, acstm, otlbckg, allcpnsimg, allcpnsdisabledimg, scrollcpnsimg, bycpnsimg, qprtimgwinnt, qprtimg, cpcimgwinnt, cpcimg, osumtxtfnt, btxtfnt, otxtfnt, patxtfnt, acpnstxt, acpnsfnt, scrlcpnstxt, scrrcpnstxt, scrcpnsfnt, bycpnstxt, bycpnsfnt, prttrackurl, cpnswebredirtrackurl, fmtX, fmtY, altCode, brdColor, bckColor, osumColor, btxtColor, otxtColor, prtActColor);

    this.browser = "macfirefox";
    this.GetBrxObjMimeType = function () {
        return ci_cap_vBrxObjMimeType;
    }
    this.SetBrxObjMimeType = function (mimeType) {
        ci_cap_vBrxObjMimeType = mimeType;
    }

    this.CheckInstall = function (iter) {
        this.installIter = iter;
        try {
            if (navigator.plugins) {
                navigator.plugins.refresh(false);
            }
            if (navigator.plugins) {
                for (i = 0; i < navigator.mimeTypes.length; i++) {
                    if ((navigator.mimeTypes[i].type != null) && (navigator.mimeTypes[i].type.indexOf("application/couponsinc-printer-plugin") != -1)) {
                        var frameObj = document.getElementById('ci_CouponClickIframe');
                        frameObj.contentDocument.open();
                        frameObj.contentDocument.write("<embed class=ci_ccss type='application/couponsinc-printer-plugin' width='1' height='1' name='NSplugBricks' id='NSplugBricks' ></embed>");
                        frameObj.contentDocument.close();
                        if (frameObj.contentDocument.embeds[0] != null) {
                            this.SetBrxObjMimeType("application/couponsinc-printer-plugin");
                            setTimeout("ci_capf_Device_" + this.id + ".CheckLoad(0);", 500);
                            return;
                        }
                    }
                }
            }
        } catch (e) {
            // ...
        }

        if (iter >= this.maxInstallIter) {
            // max install checks
            this.installIter = -1;
            return;
        } else if (iter < 0) {
            // no plug-in detected
            this.SetUserCode(0);
            this.UpdateDevice();
        } else {
            setTimeout("ci_capf_Device_" + this.id + ".CheckInstall(" + (iter + 1) + ");", 3000);
        }
    }

    // --------------------------------------------------
    this.CheckLoad = function (iter) {
        var brxObj = document.getElementById('ci_CouponClickIframe').contentDocument.embeds[0];
        if (brxObj.GetStatusCode() != 1) {
            var vUserCode = brxObj.PerformAction("cpnprt2", "GetDeviceID", "Y| |", "|", false);
            this.SetUserCode(vUserCode);
            this.UpdateDevice();
        } else if (iter > 40) {
            this.SetUserCode(0);
            this.UpdateDevice();
        } else {
            setTimeout("ci_capf_Device_" + this.id + ".CheckLoad(" + (iter + 1) + ");", 500);
        }
    }

    // --------------------------------------------------
    this.CheckPrinter = function () {
        try {
            var brxObj = document.getElementById('ci_CouponClickIframe').contentDocument.embeds[0];
            var vPrinterStatus = brxObj.PerformAction("cpnprt2", "CheckPrinter", "Y| |", "|", false);
            vPrinterStatus = (vPrinterStatus == '1' || vPrinterStatus == 'true' || vPrinterStatus == true ? 1 : vPrinterStatus);
            this.SetPrinterStatus(vPrinterStatus);
            this.EndDeviceCheck();
        } catch (e) {
            this.SetPrinterStatus(1);
            this.EndDeviceCheck();
        }
    }

    // --------------------------------------------------
    this.CheckPrinterDyn = function () {
        var vPrinterStatus = 1;
        try {
            var brxObj = document.getElementById('ci_CouponClickIframe').contentDocument.embeds[0];
            vPrinterStatus = brxObj.PerformAction("cpnprt2", "CheckPrinter", "Y| |", "|", false);
            vPrinterStatus = (vPrinterStatus == '1' || vPrinterStatus == 'true' || vPrinterStatus == true ? 1 : vPrinterStatus);
            this.SetPrinterStatus(vPrinterStatus);
        } catch (e) {
            vPrinterStatus = 1;
        }
        return vPrinterStatus;
    }

    // --------------------------------------------------
    this.Print = function (token, distributor) {
        var brxObj = document.getElementById('ci_CouponClickIframe').contentDocument.embeds[0];
        // DistributorID | CoBrand | BricksCode | ZipCode | Personalization
        var printParams = "Y|" + distributor + "|" + 0 + "|" + "DIRECT" + token + "|99999" + "| | ";
        brxObj.PerformAction("cpnprt2", "PrintCoupons", printParams, "|", !(navigator.userAgent.toLowerCase().indexOf('aol ') >= 0));
        setTimeout("ci_capf_Device_" + this.id + ".CheckPrintState();", 3000);
    }

    // --------------------------------------------------
    this.CheckPrintState = function () {
        var brxObj = document.getElementById('ci_CouponClickIframe').contentDocument.embeds[0];
        var statusCode = (typeof (brxObj.statusCode) != "undefined" ? brxObj.statusCode() : brxObj.GetStatusCode());
        if (statusCode <= -1000 || statusCode == 1) {
            // still printing
            setTimeout("ci_capf_Device_" + this.id + ".CheckPrintState();", 1000);
        } else {
            var self = this;
            setTimeout(function () {
                window["ci_capf_Device_" + ci_cap_iDateInit].UpdateInventory(self.sid);
                self.SetPrintState(0);
                self.ShowBanner(0);
            }, 5000);
            /*
        setTimeout("ci_capf_Device_"+ci_cap_iDateInit+".UpdateInventory("+this.sid+");",1000);
        this.SetPrintState(0);
        this.ShowBanner(0);
        */
        }
    }

    // --------------------------------------------------
    if (this.id == ci_cap_iDateInit) {
        if (this.setup || ci_cap_deviceBypass == "1") {
            this.SetUserCode(0);
            this.UpdateDevice();
        } else {
            this.CheckInstall(-1);
        }
    } else {
        setTimeout("ci_capf_Device_" + this.id + ".LoadScript('" + this.id + "','" + this.sid + "','" + this.bannerType + "','" + (this.setup ? 1 : 0) + "','" + this.bid + "','" + this.format + "');", 300);
    }
    var macTimeout = 12000 + 2000;

    if (this.bannerType == 3) {
        if (typeof (ci_Widget) !== 'undefined') {
            if (ci_Widget.Setup.totalBanners == 0) {
                setTimeout("ci_capf_Device_" + this.id + ".LoadScript('" + this.id + "','" + this.sid + "','" + this.bannerType + "','" + (this.setup ? 1 : 0) + "','" + this.bid + "','" + this.format + "');", 300);
            }
        } else {
            setTimeout("ci_capf_Device_" + this.id + ".LoadScript('" + this.id + "','" + this.sid + "','" + this.bannerType + "','" + (this.setup ? 1 : 0) + "','" + this.bid + "','" + this.format + "');", 300);
        }
    } else {
        setTimeout("if( !ci_capf_Device_" + this.id + ".bannerShown ) { ci_capf_Device_" + this.id + ".RenderAltBanner('timeout'); }", macTimeout);
    }
}



// =================================================
function ci_capf_Device_Unsupported(id, stp, btyp, sid, bid, chn, acstm, otlbckg, allcpnsimg, allcpnsdisabledimg, scrollcpnsimg, bycpnsimg, qprtimgwinnt, qprtimg, cpcimgwinnt, cpcimg, osumtxtfnt, btxtfnt, otxtfnt, patxtfnt, acpnstxt, acpnsfnt, scrlcpnstxt, scrrcpnstxt, scrcpnsfnt, bycpnstxt, bycpnsfnt, prttrackurl, cpnswebredirtrackurl, fmtX, fmtY, altCode, brdColor, bckColor, osumColor, btxtColor, otxtColor, prtActColor) {
    if (typeof (ci_capf_Device) == "undefined") {
        var ci_cap_conStrtemp = '(' + id + ',' + stp + ',' + btyp + ',"' + sid + '"' + ',"' + bid + '"' + ',' + (chn != null ? '"' + chn + '"' : 'null') + ',"' + acstm + '"' + ',"' + otlbckg + '"' + ',"' + allcpnsimg + '"' + ',"' + allcpnsdisabledimg + '"' + ',"' + scrollcpnsimg + '"' + ',"' + bycpnsimg + '"' + ',"' + qprtimgwinnt + '"' + ',"' + qprtimg + '"' + ',"' + cpcimgwinnt + '"' + ',"' + cpcimg + '"' + ',"' + osumtxtfnt + '"' + ',"' + btxtfnt + '"' + ',"' + otxtfnt + '"' + ',"' + patxtfnt + '"' + ',"' + acpnstxt + '"' + ',"' + acpnsfnt + '"' + ',"' + scrlcpnstxt + '"' + ',"' + scrrcpnstxt + '"' + ',"' + scrcpnsfnt + '"' + ',"' + bycpnstxt + '"' + ',"' + bycpnsfnt + '"' + ',"' + prttrackurl + '"' + ',"' + cpnswebredirtrackurl + '"' + ',"' + fmtX + '","' + fmtY + '","' + altCode + '"' + ',"' + brdColor + '"' + ',"' + bckColor + '"' + ',"' + osumColor + '"' + ',"' + btxtColor + '"' + ',"' + otxtColor + '"' + ',"' + prtActColor + '"' + ');';

        setTimeout("ci_capf_Device_" + id + " = new ci_capf_Device_Unsupported" + ci_cap_conStrtemp, 10);
        return;
    }
    ci_capf_Device.call(this, id, stp, btyp, sid, bid, chn, acstm, otlbckg, allcpnsimg, allcpnsdisabledimg, scrollcpnsimg, bycpnsimg, qprtimgwinnt, qprtimg, cpcimgwinnt, cpcimg, osumtxtfnt, btxtfnt, otxtfnt, patxtfnt, acpnstxt, acpnsfnt, scrlcpnstxt, scrrcpnstxt, scrcpnsfnt, bycpnstxt, bycpnsfnt, prttrackurl, cpnswebredirtrackurl, fmtX, fmtY, altCode, brdColor, bckColor, osumColor, btxtColor, otxtColor, prtActColor);

    this.browser = "unsupported";
    setTimeout("ci_capf_Device_" + this.id + ".RenderAltBanner('unsupported');", 500);
}

// =================================================
function ci_capf_BrowserVer(agt, brw, ver) {
    var idxAgtBrowser = agt.indexOf(brw);

    if (brw.toLowerCase() === 'firefox' && idxAgtBrowser > -1) {
        // client is using a firefox browser
        var uaBrowserString = agt.substr(idxAgtBrowser),
            origUaBrowserVer = agt.substr(agt.indexOf(brw) + brw.length + 1, 1),
            origUaBrowserVer2 = agt.substr(agt.indexOf(brw) + brw.length + 2, 1),
            uaBrowserParts = uaBrowserString.split("/"),
            uaBrowserVersionParts = uaBrowserParts.length > 1 ? uaBrowserParts[1].split(".") : undefined,
            majorVersion;

        if (uaBrowserVersionParts) {
            majorVersion = parseInt(uaBrowserVersionParts[0])
            if (majorVersion > ver) {
                return true;
            }
        }

        return false;

    } else {

        return (agt.indexOf(brw) > -1 && agt.indexOf(brw) < agt.length - (brw.length + 1) && ((agt.substr(agt.indexOf(brw) + brw.length + 1, 1) >= ver && agt.substr(agt.indexOf(brw) + brw.length + 1, 1) <= '9') || (agt.substr(agt.indexOf(brw) + brw.length + 1, 1) >= '1' && agt.substr(agt.indexOf(brw) + brw.length + 1, 1) <= '9' && agt.indexOf(brw) < agt.length - (brw.length + 2) && agt.substr(agt.indexOf(brw) + brw.length + 2, 1) >= '1' && agt.substr(agt.indexOf(brw) + brw.length + 2, 1) <= '9')));
    }
}

// =================================================
function ci_capf_InsertTopElement(type, id, attrib) {
    var parentElem = document.getElementById("ci_CouponClickElem");
    while (parentElem.offsetParent) {
        parentElem = parentElem.offsetParent;
    }
    ci_capf_InsertElement(parentElem, type, id, attrib);
}

// =================================================
function ci_capf_InsertWinsAfterBodyElement() {
    if (document.getElementsByTagName("body")) {
        var bObjs = document.getElementsByTagName("body");
        for (var i = 0; i < ci_cap_dmAds.length; i++) {
            ci_capf_InsertElement(bObjs[0], "div", "ci_WinContainerALoad_" + ci_cap_dmAds[i]);
        }
    }
}

// =================================================
function ci_capf_InsertElement(parentElem, type, id, attrib) {
    var elem = document.createElement(type);
    elem.id = id;
    elem.setAttribute("class", "ci_ccss");
    elem.style.zIndex = "2147483647";
    elem.style.position = "absolute";
    elem.style.top = "-2000px";
    elem.style.left = "-2000px";
    elem.style.width = "0px";
    elem.style.height = "0px";

    if (attrib != null && typeof (attrib) != "undefined") {
        for (var i = 0; i < attrib.length; i++) {
            elem.setAttribute(attrib[i].name, attrib[i].value);
        }
    }

    parentElem.appendChild(elem);
}

function IncludeJS(file, id) {

    var script = document.createElement('script');
    script.src = file;
    script.type = 'text/javascript';
    script.id = id;
    if (id != undefined) {
        var oldScript = document.getElementById(id);
        if (oldScript == null) {
            document.getElementsByTagName('head').item(0).appendChild(script);
        }
    } else {
        document.getElementsByTagName('head').item(0).appendChild(script);
    }
}

function IncludeCSS(file, id) {
    var stylesheet = document.createElement('link');
    stylesheet.href = file;
    stylesheet.type = 'text/css';
    stylesheet.rel = 'stylesheet';
    if (id != undefined) {
        stylesheet.id = id;
    }
    document.getElementsByTagName('head').item(0).appendChild(stylesheet);
}

IncludeJS(ci_baseDeviceJS);


if (ci_cap_altAdCode.length > 0) {
    var ci_cap_altAdCode = ci_capf_decode64(ci_cap_altAdCode);
    var ci_cap_fltCode = new Array();

    while (ci_cap_altAdCode.indexOf("<script") > -1) {
        var sScriptIx = ci_cap_altAdCode.indexOf("<script");
        if (sScriptIx > 0) {
            ci_cap_fltCode.push(ci_cap_altAdCode.substring(0, sScriptIx));
            ci_cap_altAdCode = ci_cap_altAdCode.substring(ci_cap_altAdCode.indexOf("<script"));
        }

        var eTagIx = ci_cap_altAdCode.substring(ci_cap_altAdCode.indexOf(">"));
        if (eTagIx == -1) {
            // unfinished script tag
            break;
        }

        if (ci_cap_altAdCode.charAt(eTagIx - 1) == '/') {
            // self contained script tag
            ci_cap_fltCode.push(ci_cap_altAdCode.substring(0, eTagIx + 1));
            ci_cap_altAdCode = ci_cap_altAdCode.substring(eTagIx + 1);
            continue;
        }

        eTagIx = ci_cap_altAdCode.indexOf("</script");
        if (eTagIx == -1) {
            // unfinished script tag
            break;
        }

        eTagIx = ci_cap_altAdCode.indexOf(">", eTagIx + 1);
        if (eTagIx == -1) {
            // unfinished script tag
            break;
        }

        // normal script tag
        ci_cap_fltCode.push(ci_cap_altAdCode.substring(0, eTagIx + 1));
        ci_cap_altAdCode = ci_cap_altAdCode.substring(eTagIx + 1);
    }

    // push the rest of the alt code
    ci_cap_fltCode.push(ci_cap_altAdCode);

    for (var ci_cap_fltCodeIx = 0; ci_cap_fltCodeIx < ci_cap_fltCode.length; ci_cap_fltCodeIx++) {
        if (ci_cap_fltCode[ci_cap_fltCodeIx].length > 0) {
            document.write(ci_cap_fltCode[ci_cap_fltCodeIx]);
        }
    }
}

var ci_cap_iPrinterStatus = 1,
    ci_cap_iPrintState = 0,
    ci_cap_iPrintStateCode = 1,
    ci_cap_iHwnd = 0,
    ci_cap_vBrxObjMimeType = "",
    ci_cap_allowCustomUI = true,
    ci_cap_unsupportedPrinterFlag = "unsupportedPrinter";
if (typeof (ci_cap_iDate) != "undefined") {
    ci_cap_iDate++;
} else {
    var ci_cap_iDate = (new Date()).getTime().toString();
    var ci_cap_iDateInit = ci_cap_iDate;
}
var ci_cap_bannerFmt = (typeof (ci_cap_format) == "undefined" || ci_cap_format.toString().toLowerCase().indexOf("x") == -1 ? "120x600" : ci_cap_format.toString().toLowerCase().ci_capp_trim().ci_capp_removeDoubleQuotes());
var ci_cap_bannerFmt_x = (ci_cap_bannerFmt.substring(0, ci_cap_bannerFmt.indexOf("x"))).ci_capp_trim();
var ci_cap_bannerFmt_y = (ci_cap_bannerFmt.substring(ci_cap_bannerFmt.indexOf("x") + 1)).ci_capp_trim();
ci_cap_bannerFmt = (ci_cap_bannerFmt_x + "x" + ci_cap_bannerFmt_y);
if (ci_cap_bannerFmt != "120x240" && ci_cap_bannerFmt != "120x600" && ci_cap_bannerFmt != "160x600" && ci_cap_bannerFmt != "180x150" && ci_cap_bannerFmt != "468x60" && ci_cap_bannerFmt != "300x250" && ci_cap_bannerFmt != "728x90" && ci_cap_bannerFmt != "718x940") {
    ci_cap_bannerFmt = "120x600";
    ci_cap_bannerFmt_x = "120";
    ci_cap_bannerFmt_y = "600";
}
if (typeof (ci_cap_dmAds) == "undefined") {
    var ci_cap_dmAds = new Array();
}
if (ci_cap_dmAds.length <= 6 || (typeof (ci_cap_setup) != "undefined" && ci_cap_setup == true)) {
    ci_cap_dmAds.push(ci_cap_iDate);
}
if (typeof (ci_cap_iUserCode) == "undefined") {
    var ci_cap_iUserCode = "-999";
}
if (ci_cap_bannerType != 3) {
    document.write("<style>");
    document.write(".ci_ccss_container, .ci_ccss_content, .ci_ccss_pod, .ci_ccss, .ci_ccss_tr, .ci_ccss_td, .ci_ccss_a:link, .ci_ccss_a:visited, .ci_ccss_a:hover, " + ".ci_ccss_box1, .ci_ccss_box2, .ci_ccss_box3, .ci_ccss_box4, .ci_ccss_box5, .ci_ccss_discmMsg {" + "background-attachment: scroll; background-color: transparent; background-image: none; background-position: 0%;" + "background-repeat: repeat; border-collapse: collapse; border-spacing: 0px; border: solid 0px #000000; border-width: 0px;" + "caption-side: top; clear: none; clip: auto; color: #333333; content: normal; cursor: default;" + "direction: ltr; display: block; empty-cells: show; float: none; font-family: Verdana, Tahoma, MS Sans Serif;" + "font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; height: auto;" + "letter-spacing: normal; line-height: normal; margin: auto; max-height: 10000px; max-width: 10000px;" + "min-height: 0; min-width: 0; outline-width: 0px; overflow: visible; padding-bottom: 0px;" + "padding-left: 0px; padding-right: 0px; padding-top: 0px; page-break-after: auto; page-break-before: auto;" + "page-break-inside: auto; position: static; quotes: none; table-layout: auto; text-align: left;" + "text-decoration: none; text-indent: 0; text-transform: none; unicode-bidi: normal;" + "vertical-align: top; visibility: visible; white-space: normal; width: auto; word-spacing: normal; z-index: 2147483647; }" + ".ci_ccss_pod {cursor: hand; cursor: pointer;}" + ".ci_ccss_tr {display: table-row;}" + ".ci_ccss_td {display: table-cell;}" + ".ci_ccss_a:link{color: #0068aa;text-decoration: underline;}" + ".ci_ccss_a:visited{font-size: 11px;color: #788b97;text-decoration: underline;}" + ".ci_ccss_a:hover{cursor: pointer;cursor: hand;color: #0068aa;font-size: 11px;text-decoration: none;}" + ".ci_ccss_container {background: transparent; margin:0px;}" + ".ci_ccss_box1, .ci_ccss_box2, .ci_ccss_box3 {display:block; overflow:hidden; font-size:0; height:1px;}" + ".ci_ccss_box4 {display:block; overflow:hidden; font-size:0; height:2px;}" + ".ci_ccss_box5 {display:block; overflow:hidden; font-size:0; margin:0 0px; height:16px;}" + ".ci_ccss_box2, .ci_ccss_box3, .ci_ccss_box4 {border-width: 0px;}" + ".ci_ccss_box1 {margin:0 5px;} .ci_ccss_box2 {margin:0 3px;} .ci_ccss_box3 {margin:0 2px;} .ci_ccss_box4 {margin:0 1px;}" + ".ci_ccss_discmMsg {font-size: 10px; font-weight: bold; font-family: Tahoma; color: #000000;}" + " .ci_ccss_content {display:block;}" + " .ci_brandcastTop, .ci_brandcastBottom {display:block; background:transparent; font-size:1px; margin: 0; padding: 0;}" + " .xb1, .xb2, .xb3, .xb4 {display:block; overflow:hidden; margin: 0; padding: 0;}" + " .xb1, .xb2, .xb3 {height:1px; margin: 0; padding: 0;}" + " .xb2, .xb3, .xb4 {margin: 0; padding: 0;}" + " .xb1 {margin:0 5px;}" + " .xb2 {margin:0 3px; border-width:0 2px;}" + " .xb3 {margin:0 2px;}" + " .xb4 {height:2px; margin:0 1px;}") + " .clearfix:after {content: '.'; display: block; height: 0; clear: both; visibility: hidden;}" + " * html>body .clearfix {display: inline-table; width: 100%;}" + " * html .clearfix {/* Hides from IE-mac \*/height: 1%;/* End hide from IE-mac */}";

    document.write("</style>");
}
if (ci_cap_dmAds.length == 1 && document.body == null) {
    document.write("<body class='ci_ccss_container' style='margin-top: 0px; margin-left: 0px;'></body>");
}
if (document.getElementById("ci_CouponClickElem") == null) {
    document.write("<div class=ci_ccss id='ci_CouponClickElem' style='z-index: 2147483647; position: absolute; left: -2000px; top: -2000px; border: 0px solid #000000;'></div><!--<img id='imgZipCode' src='//bc1.coupons.com/ZipCodeHandler.ashx' style='height:1px;width:1px;border-width:0px;position: absolute; left: -800px;' />-->");
    document.write("<iframe class=ci_ccss id='ci_CouponClickIframe' name='ci_CouponClickIframe' style='position: absolute; left: -2000px; top: -2000px; border: 0px solid #000000;'></iframe>");
    document.write("<div class=ci_ccss id='ci_MacControlDiv' height='1' width='1' style='position: absolute; left: -2000px; top: -2000px;'></div>");
    // parse redirect variables
    //   var ci_cap_clickImageUrlRedirVarFields = "";
    //   var ci_cap_clickImageUrlRedirVarArr = "";
    //   if( ci_cap_couponsUrl.indexOf("?") > -1 )
    //   {
    //       var ci_cap_clickImageUrlRedirVarArr = ci_cap_couponsUrl.substring(ci_cap_couponsUrl.indexOf("?")+1).split("&");
    //       for( var ci_cap_clickImageUrlRedirVarCtr = 0; ci_cap_clickImageUrlRedirVarCtr < ci_cap_clickImageUrlRedirVarArr.length; ci_cap_clickImageUrlRedirVarCtr++ )
    //       {
    //           if( ci_cap_clickImageUrlRedirVarArr[ci_cap_clickImageUrlRedirVarCtr].indexOf("=") > -1 )
    //           {
    //                var ci_cap_clickImageUrlRedirVarFldValue = ci_cap_clickImageUrlRedirVarArr[ci_cap_clickImageUrlRedirVarCtr].split("=");
    //                ci_cap_clickImageUrlRedirVarFields += '<input type="hidden" name="'+ci_cap_clickImageUrlRedirVarFldValue[0]+'" value="'+( ci_cap_clickImageUrlRedirVarFldValue[0] == "bid" ? (typeof(ci_cap_bid) == "undefined" || ci_cap_bid == null ? "" : ci_cap_bid.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) : ci_cap_clickImageUrlRedirVarFldValue[1] )+'"/>';
    //           }
    //       }
    //   }
    //document.write("<form name='ci_cap_clickImageUrlRedirForm' id='ci_cap_clickImageUrlRedirForm' action='http://print.coupons.com/couponweb/index.aspx' method='get' target='_blank' style='position: absolute; left: -2000px; top: -2000px;'>"+ci_cap_clickImageUrlRedirVarFields+"</form>");
}
if (ci_cap_bannerFmt_x != 718 && ci_cap_bannerFmt_y != 940) {
    document.write("<div class=ci_ccss id='ci_CouponClickAd_" + ci_cap_iDate + "' style='width: " + ci_cap_bannerFmt_x + "px; height: " + ci_cap_bannerFmt_y + "px; overflow: hidden; position: static; margin: 0px 0px 0px 0px; border: 0px solid #000000; display: block;'></div><script src='//bc1.coupons.com/ZipCodeHandler.ashx' type='text/javascript'></script>");
} else {
    document.write("<div class='ci_ccss ci_css_gallery_holder' id='ci_CouponClickAd_" + ci_cap_iDate + "' style='overflow: hidden; position: static; margin: 0px 0px 0px 0px; border: 0px solid #000000; display: block;'><div id='ci_css_gallery_loader' style='width: 269px;height: 36px;background: url(//cdn.cpnscdn.com/bc.coupons.com/assets_CouponClick/_themes/_images/loader.gif) no-repeat 0 0;margin: 200px auto 400px auto;padding: 30px 0 0 0; font-weight: 800; font-size: 14px; text-align: center; font-family: Arial; color: #666666;'>Loading coupons &hellip;</div></div><div id='fb-root'></div><script src='//bc1.coupons.com/ZipCodeHandler.ashx' type='text/javascript'></script>");
}


var ci_cap_conStr = '(' + ci_cap_iDate + ',' + (typeof (ci_cap_setup) != "undefined" && ci_cap_setup == true ? "true" : "false") + ',' + (typeof (ci_cap_bannerType) != "undefined" && ci_cap_bannerType == "2" ? "2" : ci_cap_bannerType == "3" ? "3" : "1") + ',"' + (typeof (ci_cap_scriptId) == "undefined" || ci_cap_scriptId == null ? "0" : ci_cap_scriptId.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) + '"' + ',"' + (typeof (ci_cap_bid) == "undefined" || ci_cap_bid == null ? "" : ci_cap_bid.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) + '"' + ',' + (typeof (ci_cap_channel) != "undefined" && ci_cap_channel != null ? '"' + ci_cap_channel.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() + '"' : 'null') + ',"' + (ci_cap_allowCustomUI == true ? "true" : "false") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_otlBckg) != "undefined" && ci_cap_otlBckg != null ? ci_cap_otlBckg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : '#96979B') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_allCpnsImg) != "undefined" && ci_cap_allCpnsImg != null ? ci_cap_allCpnsImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'allCpnsMsg/' + ci_cap_bannerFmt + '_v2.png') + '"'

+ ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_allCpnsDisabledImg) != "undefined" && ci_cap_allCpnsDisabledImg != null ? ci_cap_allCpnsDisabledImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'allCpnsMsg/' + ci_cap_bannerFmt + '_disabled.jpg') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_scrollCpnsImg) != "undefined" && ci_cap_scrollCpnsImg != null ? ci_cap_scrollCpnsImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'scrollCpns/' + ci_cap_bannerFmt + '_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_byCpnsImg) != "undefined" && ci_cap_byCpnsImg != null ? ci_cap_byCpnsImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'byCpns/' + ci_cap_bannerFmt + '_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_quickPrintImgWINNT) != "undefined" && ci_cap_quickPrintImgWINNT != null ? ci_cap_quickPrintImgWINNT.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'buttons/' + ci_cap_bannerFmt + '_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_quickPrintImg) != "undefined" && ci_cap_quickPrintImg != null ? ci_cap_quickPrintImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'buttons/' + ci_cap_bannerFmt + '_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_cpcImgWINNT) != "undefined" && ci_cap_cpcImgWINNT != null ? ci_cap_cpcImgWINNT.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'buttons/' + ci_cap_bannerFmt + '_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_cpcImg) != "undefined" && ci_cap_cpcImg != null ? ci_cap_cpcImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'buttons/' + ci_cap_bannerFmt + '_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_offerSummaryTxtFont) != "undefined" && ci_cap_offerSummaryTxtFont != null ? ci_cap_offerSummaryTxtFont.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_brandTxtFont) != "undefined" && ci_cap_brandTxtFont != null ? ci_cap_brandTxtFont.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_offerTxtFont) != "undefined" && ci_cap_offerTxtFont != null ? ci_cap_offerTxtFont.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_printActionTxtFont) != "undefined" && ci_cap_printActionTxtFont != null ? ci_cap_printActionTxtFont.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "font-family: Verdana, Tahoma, Arial, Times New Roman; font-weight: bold;") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_allCpnsTxt) != "undefined" && ci_cap_allCpnsTxt != null ? ci_cap_allCpnsTxt.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "see&nbsp;all&nbsp;coupons&nbsp;&#9658;") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_allCpnsFont) != "undefined" && ci_cap_allCpnsFont != null ? ci_cap_allCpnsFont.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "font-family: Verdana, Tahoma, Times New Roman; font-weight: bold;") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_scrollLeftCpnsTxt) != "undefined" && ci_cap_scrollLeftCpnsTxt != null ? ci_cap_scrollLeftCpnsTxt.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "&#9668;&nbsp;scroll&nbsp;c") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_scrollRightCpnsTxt) != "undefined" && ci_cap_scrollRightCpnsTxt != null ? ci_cap_scrollRightCpnsTxt.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "oupons&nbsp;&#9658;") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_scrollCpnsFont) != "undefined" && ci_cap_scrollCpnsFont != null ? ci_cap_scrollCpnsFont.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "font-family: Verdana, Tahoma, Times New Roman; font-weight: bold;") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_byCpnsTxt) != "undefined" && ci_cap_byCpnsTxt != null ? ci_cap_byCpnsTxt.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "by&nbsp;COUPONS.COM") + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_byCpnsFont) != "undefined" && ci_cap_byCpnsFont != null ? ci_cap_byCpnsFont.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "font-family: Verdana, Tahoma, Times New Roman; font-weight: bold;") + '"' + ',"' + (typeof (ci_cap_printTrackUrl) != "undefined" && ci_cap_printTrackUrl != null ? ci_cap_printTrackUrl.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "") + '"' + ',"' + (typeof (ci_cap_couponsWebsiteRedirectTrackUrl) != "undefined" && ci_cap_couponsWebsiteRedirectTrackUrl != null ? ci_cap_couponsWebsiteRedirectTrackUrl.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : "") + '"' + ',"' + ci_cap_bannerFmt_x + '","' + ci_cap_bannerFmt_y + '","' + (ci_cap_altAdCode.length > 0 ? 1 : 0) + '"' + ',"' + (typeof (ci_cap_borderColor) == "undefined" || ci_cap_borderColor == null ? "#000000" : ci_cap_borderColor.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) + '"' + ',"' + (typeof (ci_cap_backgroundColor) == "undefined" || ci_cap_backgroundColor == null ? "#198CCB" : ci_cap_backgroundColor.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) + '"' + ',"' + (typeof (ci_cap_offerSummaryColor) == "undefined" || ci_cap_offerSummaryColor == null ? "#ffffff" : ci_cap_offerSummaryColor.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) + '"' + ',"' + (typeof (ci_cap_brandTextColor) == "undefined" || ci_cap_brandTextColor == null ? "#FBF14D" : ci_cap_brandTextColor.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) + '"' + ',"' + (typeof (ci_cap_offerTextColor) == "undefined" || ci_cap_offerTextColor == null ? "#ffffff" : ci_cap_offerTextColor.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) + '"' + ',"' + (typeof (ci_cap_printActionColor) == "undefined" || ci_cap_printActionColor == null ? "#0000ff" : ci_cap_printActionColor.toString().ci_capp_trim().ci_capp_removeDoubleQuotes()) + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_allCpnsHoverImg) != "undefined" && ci_cap_allCpnsHoverImg != null ? ci_cap_allCpnsHoverImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'allCpnsMsg/' + ci_cap_bannerFmt + '_hover_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_scrollCpnsHoverImg) != "undefined" && ci_cap_scrollCpnsHoverImg != null ? ci_cap_scrollCpnsHoverImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'scrollCpns/' + ci_cap_bannerFmt + '_hover_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_byCpnsHoverImg) != "undefined" && ci_cap_byCpnsHoverImg != null ? ci_cap_byCpnsHoverImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'byCpns/' + ci_cap_bannerFmt + '_hover_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_quickPrintHoverImg) != "undefined" && ci_cap_quickPrintHoverImg != null ? ci_cap_quickPrintHoverImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'buttons/' + ci_cap_bannerFmt + '_hover_v2.png') + '"' + ',"' + (ci_cap_allowCustomUI && typeof (ci_cap_cpcHoverImg) != "undefined" && ci_cap_cpcHoverImg != null ? ci_cap_cpcHoverImg.toString().ci_capp_trim().ci_capp_removeDoubleQuotes() : ci_cap_clickImageUrl + 'buttons/' + ci_cap_bannerFmt + '_hover_v2.png') + '"' + ');';

if (navigator != null && navigator.userAgent != null && ci_capf_BrowserVer(navigator.userAgent.toLowerCase(), "msie", 6) && !(navigator.userAgent.toLowerCase().indexOf("windows 98") > -1 && navigator.userAgent.toLowerCase().indexOf("win 9x") == -1) && typeof (ci_capf_Device_IE) != "undefined" && (ci_cap_dmAds.length <= 6 || (typeof (ci_cap_setup) != "undefined" && ci_cap_setup == true))) {
    document.write("<div class=ci_ccss id='ci_WinContainer_" + ci_cap_iDate + "' style='z-index: 9999; " + (ci_cap_altAdCode.length > 0 ? "display: none; visibility: hidden;" : "") + " position: absolute; left: -2000px; top: -2000px; width: 0px; height: 0px; border: 0px solid #000000;'></div>");


    try {
        if (document.getElementById("ci_brxpdf1") == null) {
            var isPMinst = new ActiveXObject("cpbrkpie.Coupon6Ctrl.1");
            if (isPMinst != null) {
                document.write('<object class=ci_ccss id="ci_brxpdf1" codebase="" height="0" width="0" style="height: 0px; width: 0px;" classid="CLSID:9522B3FB-7A2B-4646-8AF6-36E7F593073C" name="brxpdf1" ><param name="_Version" value="65536"/><param name="_ExtentX" value="26"/><param name="_ExtentY" value="26"/><param name="_StockProps" value="0"/><param name="LocationCode" value="99999"/><param name="UserCode" value=""/><param name="BricksCode" value="USERID"/></object>');
            }
        }
    } catch (e) {}

    if (ci_cap_dmAds.length == 1) {
        var ci_capf_PrevonLoad = null;
        if (typeof (window.onload) == 'function') {
            ci_capf_PrevonLoad = window.onload;
            window.onload = function () {
                ci_capf_PrevonLoad();
                ci_capf_InsertWinsAfterBodyElement();
                return false;
            }
        } else {
            window.onload = function () {
                ci_capf_InsertWinsAfterBodyElement();
                return false;
            }
        }
    }

    setTimeout("ci_capf_Device_" + ci_cap_iDate + " = new ci_capf_Device_IE" + ci_cap_conStr, 1);
} else if (navigator != null && navigator.userAgent != null && navigator.userAgent.toLowerCase().indexOf("windows nt 4") == -1 && !(navigator.userAgent.toLowerCase().indexOf("windows 98") > -1 && navigator.userAgent.toLowerCase().indexOf("win 9x") == -1) && navigator.userAgent.toLowerCase().indexOf("windows") > -1 && ci_capf_BrowserVer(navigator.userAgent.toLowerCase(), "firefox", 1) && typeof (ci_capf_Device_Mozilla) != "undefined" && (ci_cap_dmAds.length <= 6 || (typeof (ci_cap_setup) != "undefined" && ci_cap_setup == true))) {
    ci_capf_InsertTopElement("div", "ci_WinContainer_" + ci_cap_iDate);
    setTimeout("ci_capf_Device_" + ci_cap_iDate + " = new ci_capf_Device_Mozilla" + ci_cap_conStr, 1);
} else if (navigator != null && navigator.userAgent != null && navigator.userAgent.toLowerCase().indexOf("windows") == -1 && ci_capf_BrowserVer(navigator.userAgent.toLowerCase(), "safari", 2) && ((/(Mac OS X [0-9])/.test(navigator.userAgent) && /(Mac OS X 10)([.]|[_])([4-9])/.test(navigator.userAgent)) || !(/(Mac OS X [0-9])/.test(navigator.userAgent))) && typeof (ci_capf_Device_Safari) != "undefined" && (ci_cap_dmAds.length <= 6 || (typeof (ci_cap_setup) != "undefined" && ci_cap_setup == true))) {
    ci_capf_InsertTopElement("div", "ci_WinContainer_" + ci_cap_iDate);
    setTimeout("ci_capf_Device_" + ci_cap_iDate + " = new ci_capf_Device_Safari" + ci_cap_conStr, 1);
} else if (navigator != null && navigator.userAgent != null && navigator.userAgent.toLowerCase().indexOf("windows") == -1 && ci_capf_BrowserVer(navigator.userAgent.toLowerCase(), "firefox", 2) && (/(Mac OS X 10)([.]|[_])([4-9])/.test(navigator.userAgent) || /(Mac OS X 10)([.]|[_])([3])([.]|[_])([9])/.test(navigator.userAgent)) && typeof (ci_capf_Device_MacFireFox) != "undefined" && (ci_cap_dmAds.length <= 6 || (typeof (ci_cap_setup) != "undefined" && ci_cap_setup == true))) {
    ci_capf_InsertTopElement("div", "ci_WinContainer_" + ci_cap_iDate);
    setTimeout("ci_capf_Device_" + ci_cap_iDate + " = new ci_capf_Device_MacFireFox" + ci_cap_conStr, 1);
} else if (navigator != null && navigator.userAgent != null && navigator.userAgent.toLowerCase().indexOf("windows nt 4") == -1 && !(navigator.userAgent.toLowerCase().indexOf("windows 98") > -1 && navigator.userAgent.toLowerCase().indexOf("win 9x") == -1) && navigator.userAgent.toLowerCase().indexOf("windows") > -1 && (ci_capf_BrowserVer(navigator.userAgent.toLowerCase(), "safari", 4) || ci_capf_BrowserVer(navigator.userAgent.toLowerCase(), "chrome", 3) || ci_capf_BrowserVer(navigator.userAgent.toLowerCase(), "opera", 9)) && typeof (ci_capf_Device_WinOSC) != "undefined" && (ci_cap_dmAds.length <= 6 || (typeof (ci_cap_setup) != "undefined" && ci_cap_setup == true))) {
    ci_capf_InsertTopElement("div", "ci_WinContainer_" + ci_cap_iDate);
    setTimeout("ci_capf_Device_" + ci_cap_iDate + " = new ci_capf_Device_WinOSC" + ci_cap_conStr, 1);
} else {
    // unsupported browser
    setTimeout("ci_capf_Device_" + ci_cap_iDate + " = new ci_capf_Device_Unsupported" + ci_cap_conStr, 1);
}




var ci_cap_setup = null;
var ci_cap_channel = null;
var ci_cap_bannerType = null;
var ci_cap_borderColor = null;
var ci_cap_backgroundColor = null;
var ci_cap_offerSummaryColor = null;
var ci_cap_brandTextColor = null;
var ci_cap_offerTextColor = null;
var ci_cap_otlBckg = null;
var ci_cap_allCpnsImg = null;
var ci_cap_allCpnsHoverImg = null;
var ci_cap_allCpnsDisabledImg = null;
var ci_cap_scrollCpnsImg = null;
var ci_cap_byCpnsImg = null;
var ci_cap_byCpnsHoverImg = null;
var ci_cap_quickPrintImgWINNT = null;
var ci_cap_quickPrintImg = null;
var ci_cap_quickPrintHoverImg = null;
var ci_cap_cpcImgWINNT = null;
var ci_cap_cpcImg = null;
var ci_cap_cpcHoverImg = null;
var ci_cap_offerSummaryTxtFont = null;
var ci_cap_brandTxtFont = null;
var ci_cap_offerTxtFont = null;
var ci_cap_printActionTxtFont = null;
var ci_cap_allCpnsTxt = null;
var ci_cap_allCpnsFont = null;
var ci_cap_scrollLeftCpnsTxt = null;
var ci_cap_scrollRightCpnsTxt = null;
var ci_cap_scrollCpnsFont = null;
var ci_cap_byCpnsTxt = null;
var ci_cap_byCpnsFont = null;