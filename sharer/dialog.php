<?php
$desc = urlencode("$0.75 off any Clear eyes® Product");
$name = $desc;


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
            <a href="http://www.facebook.com/dialog/feed?
              app_id=123050457758183&
              link=http://developers.facebook.com/docs/reference/dialogs/&
              picture=http://fbrell.com/f8.jpg&
              name=Facebook%20Dialogs&
              caption=Reference%20Documentation&
              description=Dialogs%20provide%20a%20simple,%20consistent%20interface%20for%20applications%20to%20interact%20with%20users.&
              message=Facebook%20Dialogs%20are%20so%20easy!&
              redirect_uri=http://www.example.com/response">FB sample</a>
        </div>
        <div>
            <a href="http://www.facebook.com/dialog/feed?
               app_id=2412324777&
               link=http://sharer.coupons.com?s=purbby&
               redirect_uri=http://sharer.coupons.com?s=purbby&
               picture=http://cdn.coupons.com/insight.coupons.com/COS20/_Cache/_ImageCache/055/16144055.gif&
               caption=From%20sharecoupon.walmart.com&
               display=popup&
               show_error=true" target="_blank">via Coupons.com qavlwv.cpns.cc</a>
        </div>

        <div>
            <a href="http://www.facebook.com/dialog/feed?
               app_id=105223049547814&
               link=http://sharer.coupons.com?s=purbby&
               redirect_uri=http://sharer.walmart.com?s=purbby&
               picture=http://cdn.coupons.com/insight.coupons.com/COS20/_Cache/_ImageCache/055/16144055.gif&
               caption=sharecoupon.walmart.com&
               description={$desc}&
               name={$desc}&
               display=popup&
               show_error=true" target="_blank">via walmart.com qavlwv.cpns.cc</a>
        </div>
    </body>
</html>
HTML;

echo $html;
?>