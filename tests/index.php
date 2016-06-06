<?php

require "../vendor/autoload.php";
use SweeterFetch\SweeterFetch;

$sf = new SweeterFetch('127.0.0.1', 'root', '5533');
$sql = 'show databases;';
$r = $sf->Eq($sql);

var_dump($r);


