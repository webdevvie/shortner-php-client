<?php

require_once "autoload.php";

require_once "config.php";

$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);

$shortLink = $client->getLink('3');
echo $shortLink->getLink()->getDescription();
echo "\nHITS:".$shortLink->getLink()->getHits();