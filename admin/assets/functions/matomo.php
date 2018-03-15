<?php

function getMatomoJSON($method) {
    $token_auth = '7595c2d70fc71731e67c3a400bc3ef87';

    $url = "https://www.scissors2you.be/piwik/";
    $url .= "?module=API&method=" . $method;
    $url .= "&idSite=1&period=month&date=today&format=json";
    $url .= "&token_auth=$token_auth";

    $fetched = file_get_contents($url);
    $content = json_decode($fetched);

    if (!$content) {
        return null;
    }  else {
        return $content;
    }
}


?>