<?php

namespace Zipcode;

class Zipcode{

    private $config;

    public function __construct(){
        $this->config = include __DIR__ .'/../config.php';
    }

    public static function get($zip){
        $zipcode = new self();
        $data = file_get_contents($zipcode->getConfig('api_url').'/get/'.$zip.'?api_key='.$zipcode->getConfig('api_key'));

        return $zipcode->parse($data);
    }

    public static function near($zip, $distance){
        $zipcode = new self();
        $data = file_get_contents($zipcode->getConfig('api_url').'/near/'.$zip.'/'.$distance.'?api_key='.$zipcode->getConfig('api_key'));

        return json_decode($data);
    }

    public function getConfig($property){
        return $this->config[$property];
    }

    public function parse($data){
        $data = json_decode($data);
        foreach($data as $key=>$value){
            $this->$key = $value;
        }

        return $this;
    }
}