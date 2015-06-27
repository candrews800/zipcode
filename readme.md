#Zipcode Library for zzipcode.com

## Install & Set Up

>composer require candrews/zipcode

Sign up on [zzipcode.com](http://zzipcode.com). It's free.

Once you've signed up, you'll be given an access key.

Plug that key into /vendor/candrews/Zipcode/src/config.php

## Usage

Get Zipcode
```php
$zipcode = new Zipcode\Zipcode(33024);
$zipcode->get();

if($zipcode->hasError()){
    echo $zipcode->getError();
}

var_dump($zipcode); // Valid $zipcode
```

Get Zipcode w/ Nearby Zipcodes
```php
$zipcode = new Zipcode\Zipcode(33024);
$zipcode->get(15);

if($zipcode->hasError()){
    echo $zipcode->getError();
}

var_dump($zipcode->near); // Array of Zipcode Objects within 15 mi of 33024
```

Get Nearby Zipcodes w/ Details
```php
$zipcode = new Zipcode\Zipcode(33024);
$zipcodes = $zipcode->near(15);

if($zipcodes->hasError()){
    echo $zipcodes->getError();
}

var_dump($zipcodes); // Array of Zipcode Objects within 15 mi of 33024
```

Get Nearby Zipcodes
```php
$zipcode = new Zipcode\Zipcode(33024);
$zipcodes = $zipcode->near(15, false);

if($zipcode->hasError()){
    echo $zipcode->getError();
}

var_dump($zipcodes); // Array of Zipcodes within 15 mi of 33024, [33328, 33023, etc..]
```

Search for Zipcodes by Location Name
```php
$zipcode = new Zipcode\Zipcode();
$zipcodes = $zipcode->search("Hollywood, FL");

if($zipcode->hasError()){
    echo $zipcode->getError();
}

var_dump($zipcodes); // Array of Zipcodes related to Hollywood, FL
```

Get Distance Between Two Zipcodes
```php
$zipcode = new Zipcode\Zipcode(33024);
$distance = $zipcode->distance(33328);

if($zipcode->hasError()){
    echo $zipcode->getError();
}

var_dump($distance); // Distance between 33024 and 33328
```


For more details regarding usage, see: [zzipcode.com PHP Library](http://zzipcode.com/docs/libraries#php)
