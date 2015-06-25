<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Zipcode\Zipcode;

$zipcode = new Zipcode(33024);
$zipcodes = $zipcode->near(10);

var_dump($zipcodes);
