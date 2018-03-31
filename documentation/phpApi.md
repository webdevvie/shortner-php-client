Shortner PHP client documentation
=====================================

This is currently a work in progress. This should not be used for production.

Creating a link
---------------
To create a link you must at least supply a url. 

A simple example: 
```php
<?php
//change this to the site you would like to use
$shortnerHostname = 'www.testo.local';
//your api key obtainable from the site running shortner.
$shortnerApiKey = 'testkey';

$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey);

$newLink = new \Shortner\API\NewLink();
$newLink->setUrl('http://www.johnbakker.name');
$shortLink = $client->createLink($newLink);
echo $shortLink->getLink()->getUrl();
```

However you may want to add a custom link. Like for example testo.link/coolstuff

```php
<?php
$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey);

$newLink = new \Shortner\API\NewLink();
$newLink->setUrl('http://www.johnbakker.name');
$newLink->setCustom('coolstuff');
$shortLink = $client->createLink($newLink);
echo $shortLink->getLink()->getUrl()."\n";
echo $shortLink->getLink()->getCustomLink();
```

Get info on a link
------------------
To get information on a link use the getLink($shortCode) method.
Sadly currently stats are not implemented in this client.
```php
<?php
$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);

$shortLink = $client->getLink('3');
echo "\n".$shortLink->getLink()->getDescription();
echo "\nHITS:".$shortLink->getLink()->getHits();
```




Collections
-----------
Collections are mainly used for podcasts. Lets say you have a show episode and instead of having to rattle off all the show's urls you can just refer to the single episode url. It is advised to use custom codes with this feature.

So lets add a collection and a couple of links to the collection.

```php
$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);

$collection = new \Shortner\API\NewLink();
$collection->setUrl('http://webdevvie.link');
$collectionResponse = $client->createLink($collection);

$newLink = new \Shortner\API\NewLink();
$newLink->setUrl('http://wiki.shortner.net');
$newLink->setCollection($collectionResponse->getLink()->getShortCode());



$shortLink = $client->createLink($newLink);
echo $collectionResponse->getLink()->getLink()."\n\n";
echo $shortLink->getLink()->getLink()."\n\n";
```

Reorder
-------
You can reorder collections. 
You do this by sending the order as an array of shortcodes and separators. 

A separator is :
AVERYUNIQUEID1234___Now your description goes here

For example:
```php
<?php
$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);


$response = $client->reOrder('show999',['a','b','UNIQUEID__My description','c']);
```
note that UNIQUEID is supposed to be a unique string. There is no check done on its uniqueness. If you mess this up it is your own fault. 

You can get the original order by requesting the collection.


Podcasts
--------
By setting the podcast flag property you can add a link or a collection to a podcast
```php
<?php
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

```

Warnings
--------
Currently only the nsfw warning is supported to be set through the api.

```php
<?php
$client = new \Shortner\ApiClient($shortnerHostname,$shortnerApiKey,$shortnerApiBasePath,$shortnerProtocol);

$newLink = new \Shortner\API\NewLink();
$newLink->setUrl('http://www.johnbakker.name');
$newLink->setWarnings(\Shortner\API\NewLink::WARNING_NSFW);

$shortLink = $client->createLink($newLink);
print_r($shortLink->getLink()->getWarnings());
``` 
