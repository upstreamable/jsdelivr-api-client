# PHP JsDelivr API client

A simple PHP client to use the [JsDelivr API](https://github.com/jsdelivr/data.jsdelivr.com).

## Requirements

* PHP >= 7.2
* Composer

## Installation

We use HTTPPlug as the HTTP client abstraction layer.
In this example, we will use [Guzzle](https://github.com/guzzle/guzzle) v6 as the HTTP client implementation.

`jsdelivr-api-client` uses [Composer](http://getcomposer.org).
The first step to use `jsdelivr-api-client` is to download composer:

```bash
$ curl -s http://getcomposer.org/installer | php
```

Then, run the following command to require the library:
```bash
$ php composer.phar require upstreamable/jsdelivr-api-client php-http/guzzle6-adapter:^2.0
```

If you want to use another HTTP client implementation, you can check [here](https://packagist.org/providers/php-http/client-implementation) the full list of HTTP client implementations.

## Getting started

### Initialise the client

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = (new \Upstreamable\JsdelivrApiClient\JsdelivrApiClientBuilder())->buildClient();
```

By default it will use the API at [data.jsdelivr.com]('https://data.jsdelivr.com/v1/')
and fetch information from [NPM](https://www.npmjs.com/).


When complete URLs are requested they will use the https://cdn.jsdelivr.net domain.

You can configure the above
```php
<?php

$client = (new \Upstreamable\JsdelivrApiClient\JsdelivrApiClientBuilder('https://data.example.com/v1/', 'gh', 'https://cdn.example.net'))->buildClient();
```

### List package versions

```php
$versions = $client->getVersionsApi()->getVersions('jquery');
print_r($versions);
```

### List tags

```php
$tags = $client->getVersionsApi()->getTags('jquery');
print_r($tags);

```

### List package files

```php
// Get a tree file structure.
$files = $client->getVersionFilesApi()->get('jquery', '3.2.1');
print_r($files);

// Using github and also a flat structure.
$files = $client->getVersionFilesApi()->get('twbs/bootstrap', '3.2.1', 'flat');
print_r($files);

// Get the default file (the 'main' key from package.json).
$file = $client->getVersionFilesApi()->getDefault('jquery', '3.2.1');
print_r($file);

// Get the files with complete URL indexed by relative path. This call returns the flat format.
$files = $client->getVersionFilesApi()->getCompleteUri('twbs/bootstrap', '3.2.1');
print_r($files);

// This will return a structure like

[
...
  "/dist/core.js" => "https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/core.js"
  "/dist/jquery.js" => "https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.js"
  "/dist/jquery.min.js" => "https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"
  "/dist/jquery.min.map" => "https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.map"
  "/dist/jquery.slim.js" => "https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.slim.js"
  "/dist/jquery.slim.min.js" => "https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.slim.min.js"
  "/dist/jquery.slim.min.map" => "https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.slim.min.map"
...
]

```

### Resolve version range
```php
$version = $client->getResolveVersionApi()->get('jquery', '3');
print_r($version);

```
## Testing

 [Install composer](https://getcomposer.org/download/)

Run:
```
composer install
vendor/bin/phpunit -c phpunit.dist.xml
vendor/bin/php-cs-fixer fix --diff --dry-run --config=.php_cs.php -vvv
```

## Support

The support of this client is made in best effort by volunteers not associated with the JsDelivr developers.

If you find a bug or want to submit an improvement, don't hesitate to raise an issue on GitLab.

## Credits

Based on the structure of the [Akeneo API client](https://github.com/akeneo/api-php-client)
