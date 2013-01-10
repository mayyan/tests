<?php
function renderSegment($podIdList, $isFirstPage) {

    $html =<<<HTML
<h2>Beverage(1)</h2>
<div class="pods">
    <div class="row">
        <div class="column grid_1">
            <div class="pod-shadow">
                <div class="pod coupon">
                    <div class="hover">
                        <p>Clip Coupon</p>
                    </div>
                    <div class="media">
                        <div class="img">
                            <a href="#"><img width="80" height="100" class="pod-image" alt="Dr Pepper®" src="http://cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/388/17555388.gif"></a>
                        </div>
                        <div class="bd">
                            <h4 class="summary">SAVE .00</h4>
                            <h5 class="brand">Dr Pepper&reg;</h5>
                            <p class="details">on (1) 24-pack or (2) 12-packs of any flavor (Reg. or Diet) Dr Pepper&reg; or Dr Pepper TEN&reg;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="column grid_1">
            <div class="pod-shadow">
                <div class="pod coupon">
                    <div class="hover">
                        <p>Clip Coupon</p>
                    </div>
                    <div class="media">
                        <div class="img">
                            <a href="#"><img width="80" height="100" class="pod-image" alt="Dr Pepper®" src="http://cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/388/17555388.gif"></a>
                        </div>
                        <div class="bd">
                            <h4 class="summary">SAVE .00</h4>
                            <h5 class="brand">Dr Pepper&reg;</h5>
                            <p class="details">on (1) 24-pack or (2) 12-packs of any flavor (Reg. or Diet) Dr Pepper&reg; or Dr Pepper TEN&reg;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="column grid_1">
            <div class="mod-ads">
                <iframe width="300" scrolling="no" height="250" frameborder="0" src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&amp;pzn=13306iq3710&amp;req=1347339507201&amp;zip=&amp;did=AMUAAREKS&amp;spage=.com/&amp;npage=1&amp;mrec=true" class="mrec"></iframe>
            </div>
        </div>

    </div> <!-- .row -->

</div> <!-- .pods -->

<h2>All Other Coupons (143)</h2>
HTML;

    return $html;
}
?>
