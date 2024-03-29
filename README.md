Softonic OAuth2 Provider
=====

[![Latest Version](https://img.shields.io/github/release/softonic/oauth2-provider.svg?style=flat-square)](https://github.com/softonic/oauth2-provider/releases)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-blue.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://github.com/softonic/oauth2-provider/actions/workflows/build.yml/badge.svg)](https://github.com/softonic/oauth2-provider/actions/workflows/build.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/softonic/oauth2-provider.svg?style=flat-square)](https://packagist.org/packages/softonic/oauth2-provider)
[![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/softonic/oauth2-provider.svg?style=flat-square)](http://isitmaintained.com/project/softonic/oauth2-provider "Average time to resolve an issue")
[![Percentage of issues still open](http://isitmaintained.com/badge/open/softonic/oauth2-provider.svg?style=flat-square)](http://isitmaintained.com/project/softonic/oauth2-provider "Percentage of issues still open")

This package provides Softonic OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

Installation
-------

You can require the last version of the package using composer
```bash
composer require softonic/oauth2-provider
```

### Configuration

```php
<?php

$options = [
    'clientId' => 'myClient',
    'clientSecret' => 'mySecret'
];

$client = new Softonic\OAuth2\Client\Provider\Softonic($options);

$token = $client->getAccessToken('client_credentials', ['scope' => 'myscope']);
```


Testing
-------

`softonic/oauth2-provider` has a [PHPUnit](https://phpunit.de) test suite, and a coding style compliance test suite using [PHP CS Fixer](http://cs.sensiolabs.org/).

To run the tests, run the following command from the project folder.

``` bash
$ make tests
```

To open a terminal in the dev environment:
``` bash
$ make debug
```

License
-------

The Apache 2.0 license. Please see [LICENSE](LICENSE) for more information.
