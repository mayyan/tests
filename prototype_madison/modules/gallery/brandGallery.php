<?php
require_once(APPLICATION_PATH . "library/constants.php");
require_once(APPLICATION_PATH . "library/library.php");
require_once(APPLICATION_PATH . "library/pod-template.php");

function renderBrandGallery() {
    $html = '';

    // Preparing all data
    $podJSON = file_get_contents(APPLICATION_PATH . "data/featuredtoday-yoplait.json");
    $podCache = json_decode($podJSON, true);
    $podHTML = array();
    foreach($podCache as $podData) {
        array_push($podHTML, renderCoupon($podData));
    }

    $html =<<<HTML
<div class="mod-gallery">
    <div class="pages">
        <div class="page">

            <div class="row">
                <div class="column grid_2">
                    <h1>Featured Yoplait Offers</h1>
                </div>

                <div class="column grid_1">
                    <ul class="share-buttons horizontal-list">
                        <li class="fb">
                            <fb:like send="false" layout="button_count" width="450" show_faces="false" font="arial" action="recommend" href="http://www.coupons.com"></fb:like>
                        </li>

                        <li class="tw">
                            <a href="http://t.co/SZ4bWq3h" class="twitter-share-button" data-via="twitterapi" data-lang="en">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        </li>

                        <li class="pin">
                            <a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Ft.co%2FSZ4bWq3h&media=http%3A%2F%2Fcdn.cpnscdn.com%2Finsight.coupons.com%2FCOS20%2F_Cache%2F_ImageCache%2F381%2F17608381.gif&description=Love%20Yoplait" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                            <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="column grid_1">
                    <div class="mod-recipe">
                        <img src="images/recipe.jpg">
                    </div>
                </div>

                <div class="column grid_2">
                    
                    <div class="row">
                        <div class="column grid_1">
                            {$podHTML[0]}
                        </div>

                        <div class="column grid_1">
                            {$podHTML[1]}
                        </div>
                    </div>

                    <div class="row">
                        <div class="column grid_1">
                            {$podHTML[2]}
                        </div>

                        <div class="column grid_1">
                            {$podHTML[3]}
                        </div>
                    </div>

                    <div class="row">
                        <div class="column grid_1">
                            {$podHTML[4]}
                        </div>

                        <div class="column grid_1">
                            {$podHTML[5]}
                        </div>
                    </div>
                </div>

            </div> <!-- .row -->
        </div> <!-- .page -->
    </div> <!-- .pages -->

    <div class="tools">
        <div class="selectall">
            <input type="checkbox" class="selectall-chk" id="couponsinc-gallery-selectall">
            <label for="couponsinc-gallery-selectall">Clip All</label>
        </div>
        <a href="#top" class="goto-top inactive">Back to Top</a>
    </div>

</div> <!--mod-gallery -->
HTML;
HTML;

    return $html;
}
?>