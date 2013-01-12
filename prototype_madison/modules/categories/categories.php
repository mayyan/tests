<?php
function renderCategories() {
    $html =<<<HTML
<div class="mod-categories">

    <div class="curr-category">
        <span>All Coupons</span>
        <span class="triangle triangle-down"></span>
    </div>

    <div class="all-categories">
        <ul>
            <li class="show-all first">
                <a data-catid="-200" href="/coupons/"><span class="title">Show All</span> (251)</a>
            </li>
            <li class="apparel">
                <a data-catid="862" href="/coupons/Apparel-Coupons-862/"><span class="title">Apparel</span> (1)</a>
            </li>
            <li class="automotive">
                <a data-catid="890" href="/coupons/Automotive-Coupons-890/"><span class="title">Automotive</span> (1)</a>
            </li>
            <li class="baby-%26-toddler">
                <a data-catid="5491" href="/coupons/Baby-%26-Toddler-Coupons-5491/"><span class="title">Baby &amp; Toddler</span> (13)</a>
            </li>
            <li class="beverages">
                <a data-catid="103" href="/coupons/Beverage-Coupons-103/"><span class="title">Beverages</span> (12)</a>
            </li>
        </ul>
        <ul>
            <li class="entertainment first">
                <a data-catid="106" href="/coupons/Entertainment-Coupons-106/"><span class="title">Entertainment</span> (1)</a>
            </li>
            <li class="flowers-%26-gifts">
                <a data-catid="886" href="/coupons/Flower-%26-Gift-Coupons-886/"><span class="title">Flowers &amp; Gifts</span> (2)</a>
            </li>
            <li class="foods">
                <a data-catid="107" href="/coupons/Food-Coupons-107/"><span class="title">Foods</span> (80)</a>
            </li>
            <li class="health-care">
                <a data-catid="104" href="/coupons/Health-Care-Coupons-104/"><span class="title">Health Care</span> (38)</a>
            </li>
            <li class="home-entertainment">
                <a data-catid="5478" href="/coupons/Home-Entertainment-Coupons-5478/"><span class="title">Home Entertainment</span> (4)</a>
            </li>
        </ul>
        <ul>
            <li class="household first">
                <a data-catid="105" href="/coupons/Household-Coupons-105/"><span class="title">Household</span> (37)</a>
            </li>
            <li class="office-supplies">
                <a data-catid="894" href="/coupons/Office-Supplies-Coupons-894/"><span class="title">Office Supplies</span> (2)</a>
            </li>
            <li class="personal-care">
                <a data-catid="101" href="/coupons/Personal-Care-Coupons-101/"><span class="title">Personal Care</span> (45)</a>
            </li>
            <li class="pet-care">
                <a data-catid="102" href="/coupons/Pet-Care-Coupons-102/"><span class="title">Pet Care</span> (8)</a>
            </li>
            <li class="photography">
                <a data-catid="579" href="/coupons/Photography-Coupons-579/"><span class="title">Photography</span> (1)</a>
            </li>
        </ul>
        <ul>
            <li class="professional-services first">
                <a data-catid="872" href="/coupons/Professional-Service-Coupons-872/"><span class="title">Professional Services</span> (4)</a>
            </li>
            <li class="restaurants">
                <a data-catid="589" href="/coupons/Restaurant-Coupons-589/"><span class="title">Restaurants</span> (2)</a>
            </li>
            <li class="static-link">
                <a href="/savingsclub/preview?pid=13306&amp;nid=10&amp;zid=iq37">Savings Club Offers</a>
            </li>
            <li class="static-link">
                <a href="/coupon-codes/?pid=13306&amp;nid=10&amp;zid=iq37">Coupon Codes</a>
            </li>
        </ul>
    </div>

    <div class="clearfix"></div>

</div> <!-- .mod-categories -->
HTML;

    return $html;
}
?>