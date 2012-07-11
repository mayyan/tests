<?php

$shortkey = "purbby";
$sharedurl = "http://{$shortkey}.cpns.cc";

//$sharedurl = "http://coupons.walmart.com?cid=16144055";

$urlencoded_shorturl = urlencode($sharedurl);


$desc = "$0.75 off any Clear eyes® Product";
$urlencoded_desc = urlencode($desc);

$html = <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <script>


        </script>
    </head>
    <body>

        <div>
            <a href="http://www.facebook.com/sharer.php?u={$urlencoded_shorturl}&t={$urlencoded_desc}">{$sharedurl}</a>
        </div>
    </body>
</html>
HTML;

echo $html;
?>