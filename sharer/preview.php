<?php
$title = "$0.75 off any Clear eyes® Product";
$htmlencoded_title = htmlentities($title);

$sharedurl = "http://coupons.walmart.com?cid=16144055";

$html = <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <title>{$htmlencoded_title}</title>
    </head>
    <body leftmargin="0" topmargin="0 marginwidth="0" marginheight="0">
        <meta name="title" content="{$htmlencoded_title}" />
        <meta name="description" content="{$htmlencoded_title}" />
        <link rel="image_src" href="http://cdn.coupons.com/insight.coupons.com/COS20/_Cache/_ImageCache/055/16144055.gif" />
        <iframe src="{$sharedurl}" width="100% height="100% frameborder="0></iframe>
    </body>
</html>
HTML;

echo $html;
?>
