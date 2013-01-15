<?php
require_once(APPLICATION_PATH . "library/constants.php");
require_once(APPLICATION_PATH . "library/library.php");
require_once(APPLICATION_PATH . "library/pod-template.php");

function renderBranchGallery() {
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
                <div class="column grid_1">
                    <div class="mod-recipe">
                        <img src="images/recipe.jpg">
                    </div>
                </div>

                <div class="column grid_2">
                    <div class="row">
                        <div class="column grid_1">
                            <button type="button" class="primary">
                                Clip All Yoplait Coupons
                            </button>
                        </div>

                        <div class="column grid_1">
                            <fb:like action="like" show_faces="false" width="90" layout="button_count" send="false" href="http://www.facebook.com/couponscom" />
                        </div>
                    </div>

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
                            {$podHTML[4]}
                        </div>
                    </div>
                </div>

            </div> <!-- .row -->
        </div> <!-- .page -->
    </div> <!-- .pages -->
</div> <!--mod-gallery -->
HTML;

    return $html;
}
?>