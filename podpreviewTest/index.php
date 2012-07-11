<!DOCTYPE html>
<html>
<head>
    <title>Pod Preview Test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css" media="all" rel="stylesheet" type="text/css" >
<style>
body {
    padding: 2em;
}
#podForm div {
    margin: 1em;
}
label {
    width: 10em;
    text-align: right;
    display: inline-block;
    font-weight: bold;
    vertical-align: top;
}
input, textarea {
    width: 45em;
}
.bold {
    font-weight: bold;
}
#previewFrame {
    display: block;
    height: 300px;
    width: 500px;
}
</style>
</head>
<body>

    <form action="genURL.php" method="get" id="podForm">
        <p>* is required field</p>
        <div>
            <label for="ThemeId">ThemeId*:</label>
            <select name="ThemeId" id="ThemeId">
                <option value="bigblue" selected>bigblue</option>
                <option value="walmart">walmart</option>
                <option value="aarp">aarp</option>
            </select>
            <input name="pid" id="pid" value="13306" type="hidden"/>
            <input name="nid" id="nid" value="10" type="hidden"/>
            <input name="zid" id="zid" value="iq37" type="hidden"/>
        </div>
        <div>
            <label for="CouponId">CouponId*:</label>
            <input name="CouponId" type="text" id="CouponId" value="12345678"/>
        </div>
        <div>
            <label for="CouponType">CouponType*:</label>
            <select name="CouponType" id="CouponType">
                <option value="0" selected>Printable</option>
                <option value="9">Duet</option>
                <option value="13">Video</option>
                <option value="15">CPC</option>
                <option value="27">Printable and Save-To-Card</option>
            </select>
        </div>
        <div>
            <label for="ImageSrc">ImageSrc*:</label>
            <input name="ImageSrc" type="text" value="http://cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/038/16830038.gif"/>
        </div>
        <div>
            <label for="CouponValue">CouponValue:</label>
            <input name="CouponValue" type="text" value="100"/>
        </div>
        <div>
            <label for="BurstText">BurstText:</label>
            <input name="BurstText" type="text" />
        </div>
        <div>
            <label for="Summary">Summary:</label>
            <input name="Summary" type="text" value="SAVE $1.00"/>
        </div>
        <div>
            <label for="BrandName">BrandName:</label>
            <input name="BrandName" type="text" value="OSCAR MAYER"/>
        </div>
         <div>
            <label for="ProdInfo">ProdInfo:</label>
            <textarea name="ProdInfo" type="text">when you buy any TWO (2) packages of OSCAR MAYER CARVING BOARD Meats or Cold Cuts</textarea>
        </div>
        <div>
            <label for="InfoUrl">InfoUrl:</label>
            <input name="InfoUrl" type="text" />
        </div>
        <div>
            <label for="LinkUrlText">LinkUrlText:</label>
            <input name="LinkUrlText" type="text" />
        </div>
        <div>
            <button type="button" id="submitBtn">Generate Pod Preview Query String</button>
        </div>
    </form>

    <span class="bold">Result:</span> <span id="result"></span>

    <iframe id="previewFrame"></iframe>


<script src="http://www.coupons.com/layouts/js/jquery.min.js"></script>
<script>
var pnz = {
    "bigblue" : {
        "pid": "13306",
        "zid": "iq37",
        "nid": "10",
        "CouponTypes": [0,9,13,15,27]
    },
    "walmart" : {
        "pid": "15429",
        "zid": "uw54",
        "nid": "10",
        "CouponTypes": [0]
    },
    "aarp" : {
        "pid": "15000",
        "zid": "jq34",
        "nid": "10",
        "CouponTypes": [0]
    }
};
var CouponTypes = {
    0 : "Printable",
    9 : "Duet",
    13: "Video",
    15: "CPC",
    27: "Printable and Save-To-Card"
}
$("#ThemeId").change(function(event) {
    var theme = $("option:selected", $(this)).val();

    $("#pid").val(pnz[theme].pid);
    $("#zid").val(pnz[theme].zid);
    $("#nid").val(pnz[theme].nid);

    $("#CouponType").empty();
    $.each(pnz[theme].CouponTypes, function(index, ctype) {
        $("<option value=\""+ctype+"\">"+CouponTypes[ctype]+"</option>").appendTo("#CouponType");
    });
});
$("#submitBtn").click(function() {
    var qs = $("#podForm").serialize();
    $.get("genURL.php?"+qs, function(data) {
        $("#result").html(data);
        $("#previewFrame").attr("src", "http://vdevusvr06.corp.coupons.com/podpreview?"+data);
    });
    
});
</script>
</body>
</html>
