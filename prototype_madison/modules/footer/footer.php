<?php
function renderFooter() {
    $html =<<<HTML
<div class="mod-footer">
    <div class="ft">
    &copy;&nbsp;2013 Coupons.com Incorporated. All Rights Reserved.

<a href="http://www.couponsinc.com/corporate/Terms.aspx" target="_new">Terms of Use</a>
&nbsp;|&nbsp;<a href="http://www.couponsinc.com/corporate/Privacy.aspx" target="_new">Privacy Policy</a>    <ul class="horizontal-list endorsements">
        <li>
            <a target="_new" href="http://www.truste.org/ivalidate.php?url=www.coupons.com&amp;sealid=102" title="TRUSTe" class="sprite-icons endorse truste"></a>
        </li>
        <li>
            <a target="_new" href="http://sanjose.bbb.org/businessreport.aspx?companyid=223835#sealclick" title="Click for the Business Review of Coupons.com Incoporated, a Marketing Programs &amp; Services in Mountain View CA" class="sprite-icons endorse bbb"></a>
        </li>
    </ul>
    </div>
</div> <!-- .footer -->
HTML;

    return $html;
}