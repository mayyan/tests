<?php
function renderMREC($isFirstPage) {
    $src = '';
    $cssClass = 'house-ad';
    if ($isFirstPage) {
        $cssClass = "mrec";
        $src = 'src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage=1&mrec=true"';
    }
    $html =<<<HTML
    <div class="mod-ads">
        <iframe scrolling="no" frameborder="0" width="300" height="250" class="{$cssClass}" {$src}></iframe>
    </div>
HTML;
    return $html;
}
?>