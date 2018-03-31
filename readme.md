Shortner 4.0 client
===================

Written by: [John Bakker](http://www.johnbakker.name)

STILL VERY MUCH WORK IN PROGRESS! Don't use this for production yet ;)

Links:
------
- [Documentation](documentation/index.md)
- [Twitter](http://www.twitter.com/shortner_net)


Quick start
-----------

Use composer to get the latest version
```
composer require webdevvie/shortner-php-client
```

Then make a connection
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

Of course there are quite a few properties of info you can get.

Podcaster ?
-----------
Get in touch and we can work out a custom shortner for your show! for as low as €80,- a year
