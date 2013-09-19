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
<link rel="stylesheet" href="modules/pods/pod.css">

<style>
.gallery {
    padding: 0;
}
</style>
</head>

<body>
    <div data-role="page" id="page-couponcodes">

        <?php include("navpanel.php"); ?>

        <div data-role="header">
            <a href="#navpanel" data-role="button" data-inline="true" data-icon="bars">More</a>
            <h1>Coupon Codes</h1>
            <?php include("modules/search/search.php"); ?>
        </div><!-- /header -->

        <div data-role="content" id="content">

        </div><!-- /content -->

        <div data-role="footer" class="ui-bar">
            &copy; 2013 Coupons Inc.
        </div><!-- /footer -->

    </div><!-- /page couponcodes -->

<!-- templates -->
<?php include("templates/store.js"); ?>
<?php include("templates/pod.js"); ?>

<!-- vendor dependencies -->
<script src="vendor/underscore/underscore.js"></script>
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/backbone/backbone.js"></script>
<script src="vendor/jquery-mobile/jquery.mobile.js"></script>
<script src="vendor/owl-carousel/owl-carousel/owl.carousel.js"></script>

<!-- application components -->
<script src="modules/search/search.js"></script>
<script src="modules/stores/stores.js"></script>
<script src="modules/pods/pods.js"></script>

<script>
var storesView = new StoresView({ collection: storeCollection });
$('#page-couponcodes #content').append(storesView.render().el);

var podsView_1 = new PodsView({ collection: podCollection_1 });
var podsView_2 = new PodsView({ collection: podCollection_2 });
var podsView_3 = new PodsView({ collection: podCollection_3 });
$('.gallery[data-store-id="1"]').append(podsView_1.render().el);
$('.gallery[data-store-id="2"]').append(podsView_2.render().el);
$('.gallery[data-store-id="3"]').append(podsView_3.render().el);
$(document).ready(function() {
    // var storesView = new StoresView({ collection: storeCollection });
    // $('#page-couponcodes #content').append(storesView.render().el);

    // var podsView_1 = new PodsView({ collection: podCollection_1 });
    // var podsView_2 = new PodsView({ collection: podCollection_2 });
    // var podsView_3 = new PodsView({ collection: podCollection_3 });
    // $('.gallery[data-store-id="1"]').append(podsView_1.render().el);
    // $('.gallery[data-store-id="2"]').append(podsView_2.render().el);
    // $('.gallery[data-store-id="3"]').append(podsView_3.render().el);

    $(".pods").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds

        items: 3,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]

    });
 
});
</script>
</body>
</html>
