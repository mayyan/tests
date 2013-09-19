<!doctype html>
<html>
<head>
    <title>Coupons.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="vendor/normalize.css">
    <link rel="stylesheet" href="vendor/jquery-mobile/jquery.mobile.css">

    <link rel="stylesheet" href="vendor/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl-carousel/owl-carousel/owl.theme.css">

    <link rel="stylesheet" href="modules/search/search.css">
    <link rel="stylesheet" href="modules/featured/featured.css">
</head>

<body>
    <div data-role="page" id="page-home">

        <?php include("navpanel.php"); ?>

        <div data-role="header">
            <a href="#navpanel" data-role="button" data-inline="true" data-icon="bars">More</a>
            <h1>Coupons.com</h1>
            <?php include("modules/search/search.php"); ?>
        </div><!-- /header -->

        <div data-role="content">
            <?php include("modules/featured/featured.php"); ?>
        </div><!-- /content -->

        <div data-role="footer" class="ui-bar">
            &copy; 2013 Coupons Inc.
        </div><!-- /footer -->

    </div><!-- /page home -->

<!-- vendor dependencies -->
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/jquery-mobile/jquery.mobile.js"></script>
<script src="vendor/owl-carousel/owl-carousel/owl.carousel.js"></script>

<!-- application components -->
<script src="modules/search/search.js"></script>
<script src="modules/featured/featured.js"></script>
</body>
</html>

