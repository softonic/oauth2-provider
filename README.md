Softonic OAuth2 Provider
=====

[![Latest Version](https://img.shields.io/github/release/softonic/oauth2-provider.svg?style=flat-square)](https://github.com/softonic/oauth2-provider/releases)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-blue.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/softonic/oauth2-provider/master.svg?style=flat-square)](https://travis-ci.org/softonic/oauth2-provider)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/softonic/oauth2-provider.svg?style=flat-square)](https://scrutinizer-ci.com/g/softonic/oauth2-provider/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/softonic/oauth2-provider.svg?style=flat-square)](https://scrutinizer-ci.com/g/softonic/oauth2-provider)
[![Total Downloads](https://img.shields.io/packagist/dt/softonic/oauth2-provider.svg?style=flat-square)](https://packagist.org/packages/softonic/oauth2-provider)

This package provides Softonic OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

Installation
-------

To install, use composer:

```
composer require softonic/oauth2-provider
```

Usage
-------

``` php
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

`softonic/oauth2-provider` has a [PHPUnit](https://phpunit.de) test suite and a coding style compliance test suite using [PHP CS Fixer](http://cs.sensiolabs.org/).

To run the tests, run the following command from the project folder.

``` bash
$ docker-compose run test
```

To run interactively using [PsySH](http://psysh.org/):
``` bash
$ docker-compose run interactive
```

License
-------

The Apache 2.0 license. Please see [LICENSE](LICENSE) for more information.

[PSR-2]: http://www.php-fig.org/psr/psr-2/
[PSR-4]: http://www.php-fig.org/psr/psr-4/
