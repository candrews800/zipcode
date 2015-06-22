<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Zipcode\Zipcode;

$zipcodes = Zipcode::get("33024, 27615", 5);

foreach($zipcodes[1]->near as $zip){
    var_dump($zip->city);
}
