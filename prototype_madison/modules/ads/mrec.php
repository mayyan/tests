<?php
function renderMREC($isFirstPage) {
    global $Config;
    
    if ($Config["TakeOver"] == 1) {

        $html =<<<HTML
<div data-popup="0" data-inhouse="0" class="mod-ads container-300x250">
    <img alt="Advertise with us" src="images/mrec.jpg">
</div>
HTML;

    } else {

        $src = '';
        $cssClass = 'house-ad';
        if ($isFirstPage) {
            $cssClass = "mrec";
            $src = 'src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage=1&mrec=true"';
        }
        $html =<<<HTML
<div data-popup="0" data-inhouse="0" class="mod-ads container-300x250">
    <iframe scrolling="no" frameborder="0" style="height:250px;width:300px" {$src}></iframe>
</div>
HTML;
    }

    return $html;
}
?>