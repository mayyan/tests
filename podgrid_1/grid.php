<?php
include ("util.php");
?>
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
.ad1x1 {
    height: 100px;
}
.ad1x2 {
    height: 200px;
}
.ad2x2 {
    height: 200px;
}
.ad3x1 {
    height: 150px;
}
.ad1x3,
.ad2x3 {
    height: 300px;
}
</style>

</head>
<body>
Using 1kbgrid system.
    <div class="mod-gallery">
<?php
$rows = cutRows($adsConfig);
foreach($rows as $rowIndex => $row) {
    selectTemplate($row, $rowIndex);
    //selectTemplate1($row);
}

?>
    </div>
Other content
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>

</body>
</html>