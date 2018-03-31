<?php

require_once "autoload.php";

require_once "config.php";

$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);

$newLink = new \Shortner\API\NewLink();
$newLink->setUrl('http://www.johnbakker.name');
$newLink->setCustom('test'.rand(0,1000));

$shortLink = $client->createLink($newLink);
echo $shortLink->getLink()->getCustomLink();
print_r($shortLink);