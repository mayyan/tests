<?php
const GridWidth = 3;

const GridSize = 18;

const ModuleSize_Super        = "super";
const ModuleSize_Double       = "double";
const ModuleSize_ShortStack   = "shortstack";
const ModuleSize_Grid         = "grid";

const UserState_New       = 1;
const UserState_SignedOut = 2;
const UserState_SignedIn  = 3;

/**
 * Modules can be injected into Gallery are:
 *  - offeroftheweek
 *  - savingsclub
 *  - supersaver
 *  - featuredtoday
 */
/* Mock 1: http://www.zurb.net/coupons/projects/interaction-design/implement/images/layouts/0910/1.jpg */
$Config1 = array(
    "UserState" => UserState_New,
    "TakeOver" => 0,
    "TopRow" => array(
        "format" => ModuleSize_ShortStack,
        "modules" => array("offeroftheweek", "savingsclub")
    ),
    "Gallery" => array( /* they are module names not used in TopRow, and their grid positions, starting from 1, the frist pod below TopRow */
        "featuredtoday" => 3,
        "featuredtoday2" => 21,
        "featuredtoday3" => 39,
    )
);

/* Mock 2: http://www.zurb.net/coupons/projects/interaction-design/implement/images/layouts/0910/2.jpg */
$Config2 = array(
    "UserState" => UserState_SignedOut,
    "TakeOver" => 0,
    "TopRow" => array(
        "format" => ModuleSize_ShortStack,
        "modules" => array("offeroftheweek", "savingsclub")
    ),
    "Gallery" => array( /* they are module names not used in TopRow, and their grid positions, starting from 1, the frist pod below TopRow */
        "featuredtoday" => 3,
        "featuredtoday2" => 21,
        "featuredtoday3" => 39,
    )
);

/* Mock 3: http://www.zurb.net/coupons/projects/interaction-design/implement/images/layouts/0910/3.jpg */
$Config3 = array(
    "UserState" => UserState_SignedIn,
    "TakeOver" => 1,
    "TopRow" => array(
        "format" => ModuleSize_ShortStack,
        "modules" => array("offeroftheweek", "savingsclub")
    ),
    "Gallery" => array( /* they are module names not used in TopRow, and their grid positions, starting from 1, the frist pod below TopRow */
        "featuredtoday" => 3,
        "featuredtoday2" => 21,
        "featuredtoday3" => 39,
    )
);

$configIndex = empty($_GET["config"]) ? 3 :$_GET["config"];
$ConfigName = "Config" . $configIndex;
$Config = $$ConfigName;
?>