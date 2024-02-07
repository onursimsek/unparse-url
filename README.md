# Unparse Url

[![Latest Version on Packagist](https://img.shields.io/packagist/v/onursimsek/unparse-url.svg?style=flat-square)](https://packagist.org/packages/onursimsek/unparse-url)
[![Total Downloads](https://img.shields.io/packagist/dt/onursimsek/unparse-url.svg?style=flat-square)](https://packagist.org/packages/onursimsek/unparse-url)

# Installation

You can install the package via composer:

``` bash
composer require onursimsek/unparse-url
```

# Usage

This package reverses `parse_url()` result. Here's a demo of how you can use it:

```php
$parsedUrl = parse_url('https://github.com/onursimsek/unparse-url');
/*[
    "scheme" => "https",
    "host" => "github.com",
    "path" => "/onursimsek/unparse-url",
]*/

echo new UnparseUrl\UnparseUrl($parsedUrl);
// https://github.com/onursimsek/unparse-url
```

You can use helper function.

```php
$parsedUrl = [
    'scheme' => 'https',
    'host' => 'github.com',
    'path' => '/onursimsek/unparse-url',
];

echo unparse_url($parsedUrl);
// https://github.com/onursimsek/unparse-url
```
