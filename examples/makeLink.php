<?php

require_once "autoload.php";

require_once "config.php";

$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);

$newLink = new \Shortner\API\NewLink();
$newLink->setUrl('http://www.johnbakker.name');


$shortLink = $client->createLink($newLink);
echo $shortLink->getLink()->getLink();