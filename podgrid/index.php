<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.6.0/build/cssreset/cssreset-min.css">
<style>
    .mod-gallery {
        border: 1px solid #990000;
        position: relative;
    }
    .clearfix {
        clear: both;
        content: " ";
        display: block;
    }
    .pod {
        border: 1px solid #000;
        margin: 2px;
        position: absolute;
    }
    .coupon {
        width: 200px;
        height: 100px;
    }
    .adblob,
    .adtech {
        width: 200px;
        height: 200px;
    }
    .col1 {
        left: 0;
    }
    .col2 {
        left: 200px;
    }
    .col3 {
        left: 400px;
    }
    .row1 {
        top: 0;
    }
    .row2 {
        top: 100px;
    }
    .row3 {
        top: 200px;
    }
    .row4 {
        top: 300px;
    }
</style>

</head>
<body>
Using absolute position. Calculated top/left.
    <div class="mod-gallery">

        <div class="pod coupon col1 row1">Printable 1</div>
        <div class="pod coupon col2 row1">Printable 2</div>
        <div class="pod adblob col3 row1">AdBlob 3</div>
        <div class="pod coupon col1 row2">Printable 5</div>
        <div class="pod coupon col2 row2">Printable 6</div>

        <div class="pod adtech col0 row3">AdTech 7</div>
        <div class="pod coupon col2 row3">Printable 8</div>
        <div class="pod coupon col3 row3">Printable 9</div>
        <div class="pod coupon col2 row4">Printable 11</div>
        <div class="pod coupon col3 row4">Printable 12</div>
    </div>
Other content
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>

</body>
</html>