<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.6.0/build/cssreset/cssreset-min.css">
<style>
/* ================ */
/* = The 1Kb Grid = */     /* 9 columns, 60 pixels each, with 10 pixel gutter */
/* ================ */
.grid_1 { width:60px; }
.grid_2 { width:130px; }
.grid_3 { width:200px; }
.grid_4 { width:270px; }
.grid_5 { width:340px; }
.grid_6 { width:410px; }
.grid_7 { width:480px; }
.grid_8 { width:550px; }
.grid_9 { width:620px; }

.column {
	margin: 0 5px;
	overflow: hidden;
	float: left;
	display: inline;
}
.row {
	width: 630px;
	margin: 0 auto;
	overflow: hidden;
}
.row .row {
	margin: 0 -5px;
	width: auto;
	display: inline-block;
}
</style>

<style>
.mod-gallery {
    border: 1px solid #990000;
}
.pod {
    border: 1px solid #000;
}
.coupon {
    height: 100px
}
.adblob,
.adtech {
    height: 200px;
}
.ads2x2 {
    height: 200px;
}
.ads-leaderboard {
    height: 150px;
}
</style>

</head>
<body>
Using 1kbgrid system.
    <div class="mod-gallery">
        <div class="row">
            <div class="column grid_6">
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (1,1)</div></div>
                    <div class="column grid_3"><div class="pod coupon">Coupon (1,2)</div></div>
                </div>
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (2,1)</div></div>
                    <div class="column grid_3"><div class="pod coupon">Coupon (2,2)</div></div>
                </div>
            </div>
            <div class="column grid_3"><div class="pod adblob">AdBlob (1, 3) (2,3)</div></div>
        </div>

        <div class="row">
            <div class="column grid_9">
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (3,1)</div></div>
                    <div class="column grid_3"><div class="pod coupon">Coupon (3,2)</div></div>
                    <div class="column grid_3"><div class="pod coupon">Coupon (3,3)</div></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column grid_3"><div class="pod adtech">AdTech (4,1) (5,1)</div></div>
            <div class="column grid_6">
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (4,2)</div></div>
                    <div class="column grid_3"><div class="pod coupon">Coupon (4,3)</div></div>
                </div>
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (5,2)</div></div>
                    <div class="column grid_3"><div class="pod coupon">Coupon (5,3)</div></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column grid_3">
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (6,1)</div></div>
                </div>
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (7,1)</div></div>
                </div>
            </div>
            <div class="column grid_3">
                <div class="row">
                    <div class="column grid_3"><div class="pod adtech">AdTech (6, 2) (7,2)</div></div>
                </div>
            </div>
            <div class="column grid_3">
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (6,3)</div></div>
                </div>
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (7,3)</div></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column grid_3">
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (8,1)</div></div>
                </div>
                <div class="row">
                    <div class="column grid_3"><div class="pod coupon">Coupon (9,1)</div></div>
                </div>
            </div>
            <div class="column grid_6"><div class="pod ads2x2">Big Ads (8,2)(8,3)(9,2)(9,3)</div></div>
        </div>

        <div class="row">
            <div class="column grid_9"><div class="pod ads-leaderboard">Leaderboard (10,1-3)(11,1-3)</div></div>
        </div>
    </div>
Other content
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>

</body>
</html>