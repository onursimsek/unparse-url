# Unparse Url

[![Latest Version on Packagist](https://img.shields.io/packagist/v/onursimsek/unparse-url.svg?style=flat-square)](https://packagist.org/packages/onursimsek/unparse-url)
[![Total Downloads](https://img.shields.io/packagist/dt/onursimsek/unparse-url.svg?style=flat-square)](https://packagist.org/packages/onursimsek/unparse-url)

This package reverses `parse_url()` result

Here's a demo of how you can use it:

```php
echo new UnparseUrl\UnparseUrl(parse_url('https://github.com/onursimsek/unparse-url'));
```

You can use helper function.

```php
echo unparse_url(parse_url('https://github.com/onursimsek/unparse-url'));
```

# Installation

You can install the package via composer:

``` bash
composer require onursimsek/unparse-url
```