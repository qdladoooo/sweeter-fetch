##Sweeter-fetch - a Database fetching library
Wrapper for PDO.

Procedure oriented, Pre process, As supplement of ORM.

[![Build Status](https://secure.travis-ci.org/qdladoooo/sweeter-fetch.png?branch=master)](https://travis-ci.org/qdladoooo/sweeter-fetch)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://opensource.org/licenses/MIT)
[![Version](https://img.shields.io/packagist/vpre/qdladoooo/sweeter-fetch.svg)](https://packagist.org/packages/qdladoooo/sweeter-fetch)
##Installation
```shell
composer require qdladoooo/sweeter-fetch
```
##Initialization
```php
require "../vendor/autoload.php";
use SweeterFetch\SweeterFetch;

$sf = new SweeterFetch('host', 'username', 'password');
```
##Use
Execute none query

```php
//return nothing
$sf->Enq('use candy_shop;');
```

Execute query

```php
//return [row1, row2, ...]
$sf->Eq($sql);
```
Execute one row

```php
//return the first row by array
$sf->Eor($sql);
```

Execute column

```php
//return a column
$sf->Ec($sql);
```

Execute scalar 

```php
//return a number
$sf->Es($sql);
```


