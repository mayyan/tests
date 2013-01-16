<?php
function renderCategories() {
    $html =<<<HTML
<li class="cssMenui0 mod-categories">

    <a class="cssMenu-title"><span>All Categories&nbsp;<strong class="triangle triangle-down"></strong></span></a>

    <ul class="cssMenu-sub">
        <li class="cssMenu-item all-categories">

            <div class="cat-col">
                <a data-catid="-200" href="/coupons/"><strong class="title">Show All</strong>&nbsp;(251)</a>
                <a data-catid="862" href="/coupons/Apparel-Coupons-862/"><strong class="title">Apparel</strong>&nbsp;(1)</a>
                <a data-catid="890" href="/coupons/Automotive-Coupons-890/"><strong class="title">Automotive</strong>&nbsp;(1)</a>
                <a data-catid="5491" href="/coupons/Baby-%26-Toddler-Coupons-5491/"><strong class="title">Baby &amp; Toddler</strong>&nbsp;(13)</a>
                <a data-catid="103" href="/coupons/Beverage-Coupons-103/"><strong class="title">Beverages</strong>&nbsp;(12)</a>
            </div>

            <div class="cat-col">
                <a data-catid="106" href="/coupons/Entertainment-Coupons-106/"><strong class="title">Entertainment</strong>&nbsp;(1)</a>
                <a data-catid="886" href="/coupons/Flower-%26-Gift-Coupons-886/"><strong class="title">Flowers &amp; Gifts</strong>&nbsp;(2)</a>
                <a data-catid="107" href="/coupons/Food-Coupons-107/"><strong class="title">Foods</strong>&nbsp;(80)</a>
                <a data-catid="104" href="/coupons/Health-Care-Coupons-104/"><strong class="title">Health Care</strong>&nbsp;(38)</a>
                <a data-catid="5478" href="/coupons/Home-Entertainment-Coupons-5478/"><strong class="title">Home Entertainment</strong>&nbsp;(4)</a>
            </div>
            <div class="cat-col">
                <a data-catid="105" href="/coupons/Household-Coupons-105/"><strong class="title">Household</strong>&nbsp;(37)</a>
                <a data-catid="894" href="/coupons/Office-Supplies-Coupons-894/"><strong class="title">Office Supplies</strong>&nbsp;(2)</a>
                <a data-catid="101" href="/coupons/Personal-Care-Coupons-101/"><strong class="title">Personal Care</strong>&nbsp;(45)</a>
                <a data-catid="102" href="/coupons/Pet-Care-Coupons-102/"><strong class="title">Pet Care</strong>&nbsp;(8)</a>
                <a data-catid="579" href="/coupons/Photography-Coupons-579/"><strong class="title">Photography</strong>&nbsp;(1)</a>
            </div>
            <div class="cat-col">
                <a data-catid="872" href="/coupons/Professional-Service-Coupons-872/"><strong class="title">Professional Services</strong>&nbsp;(4)</a>
                <a data-catid="589" href="/coupons/Restaurant-Coupons-589/"><strong class="title">Restaurants</strong>&nbsp;(2)</a>
                <a href="/savingsclub/preview?pid=13306&amp;nid=10&amp;zid=iq37"><strong class="title">Savings Club Offers</strong></a>
                <a href="/coupon-codes/?pid=13306&amp;nid=10&amp;zid=iq37"><strong class="title">Coupon Codes</strong></a>
            </div>
        </li>
    </ul>

</li> <!-- .mod-categories -->
HTML;

    return $html;
}
?>