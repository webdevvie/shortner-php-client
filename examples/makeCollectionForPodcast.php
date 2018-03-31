<?php

require_once "autoload.php";

require_once "config.php";

$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);

$collection = new \Shortner\API\NewLink();
$collection->setUrl('http://webdevvie.link');
$collection->setPodcast('polymaticast');
$collectionResponse = $client->createLink($collection);

$newLink = new \Shortner\API\NewLink();
$newLink->setUrl('http://wiki.shortner.net');
$newLink->setCollection($collectionResponse->getLink()->getShortCode());



$shortLink = $client->createLink($newLink);
echo $collectionResponse->getLink()->getLink()."\n\n";
echo $shortLink->getLink()->getLink()."\n\n";

print_r($collectionResponse);
