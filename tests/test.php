<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Zipcode\Zipcode;

$zipcodes = Zipcode::near(33024, 10, false);

var_dump($zipcodes);
