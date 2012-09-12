<?php
if ($topRowType == "1") {

    echo <<<HTML
    <div class="row toprow-type-1">
        <div class="column grid_1">
HTML;
        include("offeroftheweek.php");
        echo <<<HTML
        </div>

        <div class="column grid_1">
HTML;
        include("savingsclub.php");
        echo <<<HTML
        </div>

        <div class="column grid_1">
            <div class="mrec">
                <iframe scrolling="no" frameborder="0" width="300" height="250" src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage=1"></iframe>
            </div>
        </div>
    </div>
HTML;
} else if ($topRowType == "2") {
    echo <<<HTML
    <div class="row toprow-type-2">
        <div class="column grid_2">
HTML;
        include("offeroftheweek.php");
        echo <<<HTML
        </div>

        <div class="column grid_1">
            <div class="mrec">
                <iframe scrolling="no" frameborder="0" width="300" height="250" src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage=1"></iframe>
            </div>
        </div>
    </div>
HTML;
} else if ($topRowType == "3") {
    echo <<<HTML
    <div class="row toprow-type-3">
        <div class="column grid_2">
            <div class="row">
                <div class="column grid_2">
HTML;
    include("offeroftheweek.php");
    echo <<<HTML
                </div>
            </div>

            <div class="row">
                <div class="column grid_2">
HTML;
    include("savingsclub.php");
    echo <<<HTML
                </div>
            </div>
        </div>

        <div class="column grid_1">
            <div class="mrec">
                <iframe scrolling="no" frameborder="0" width="300" height="250" src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage=1"></iframe>
            </div>
        </div>
    </div>
HTML;
}
?>