#Zipcode Library for zzipcode.com

## Install & Set Up

>composer require candrews/zipcode

Sign up on [zzipcode.com](http://zzipcode.com). It's free.

Once you've signed up, you'll be given an access key.

Plug that key into /vendor/candrews/Zipcode/src/config.php

## Usage
For more details regarding usage, see: [zzipcode.com PHP Library](http://zzipcode.com/docs/libraries#php)


####Get Zipcode

>// Get Details About Zipcode
>$zipcode = new Zipcode\Zipcode(33024);
>$zipcode->get();
>
>if($zipcode->hasError()){
>    echo $zipcode->getError();
>}
>
>var_dump($zipcode); // Valid $zipcode

