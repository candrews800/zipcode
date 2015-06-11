<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Zipcode\Zipcode;

$zipcode = Zipcode::near(33024,25);

foreach($zipcode as $zip){
    echo $zip . ', ';
}