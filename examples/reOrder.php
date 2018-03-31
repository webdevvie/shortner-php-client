<?php

require_once "autoload.php";

require_once "config.php";

$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);


$response = $client->reOrder('show999',['a','b','UNIQUEID__My description','c']);

print_r($response);