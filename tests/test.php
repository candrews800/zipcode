<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Zipcode\Zipcode;

$zipcode = new Zipcode(330124);
$zipcode->get();

if($zipcode->hasError()){
    echo $zipcode->getError();
}
// Valid $zipcode
