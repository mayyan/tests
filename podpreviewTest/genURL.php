<?php
function generateQuerySignature($queryString, $secret, $hashAlgo = 'sha1')  {
    // temporarily strip off the ? of the query string
    $queryString = ltrim($queryString, '?');

    // sort the params by key and value and put them back into a string
    $queryParams = explode('&', $queryString);
    sort($queryParams);
    $queryString = implode('&', $queryParams);

    // add the ? back to the beginning of the query string
    $queryString = '?' . $queryString;
    return hash_hmac($hashAlgo, $queryString, $secret);
}


$hashAlgo = 'sha1';
$secret = 'a20e89682c04f3c7d938ac5a02c4e8fc071914aa';

$ts = time();
$queryString = $_SERVER['QUERY_STRING'].'&ts='.$ts;


//echo 'SERVER_NAME='.$_SERVER['SERVER_NAME'].'<br/>';
//echo "QUERY_STRING=".$_SERVER['QUERY_STRING'].'<br/>';
//echo "ts=".$ts.'<br/>';
$sig = generateQuerySignature($queryString, $secret);
echo $queryString."&sig=".$sig;
