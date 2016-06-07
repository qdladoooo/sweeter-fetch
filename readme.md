##Sweeter-fetch - a Database fetching library
Wrapper for PDO.

Procedure oriented, Pre process, As supplement of ORM.

##Build status
[![Build Status](https://secure.travis-ci.org/qdladoooo/sweeter-fetch.png?branch=master)](https://travis-ci.org/qdladoooo/sweeter-fetch)

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
Excute query

```php
//return [row1, row2, ...]
$sf->Eq($sql);
```
Excute one row

```php
//return the first row by array
$sf->Eor($sql);
```

Excute col

```php
//return a cell
$sf->Ec($sql);
```

Excute scalar 

```php
//return a number
$sf->Es($sql);
```


