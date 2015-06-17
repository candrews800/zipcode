<?php namespace Zipcode;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Zipcode{

    private $config;

    public function __construct(){
        $this->config = include __DIR__ .'/../config.php';
    }

    public static function get($zip){
        $zipcode = new self();

        $client = new Client();
        try{
            $res = $client->get($zipcode->getConfig('api_url') . '/get/'.$zip. '?api_key='.$zipcode->getConfig('api_key'));
        } catch(RequestException $e){
            if ($e->hasResponse()) {
                return $e->getResponse()->getBody()->getContents();
            }
        }

        $data = json_decode($res->getBody()->getContents());

        if(isset($data->error)){
            return 'Errors found.';
        }

        foreach($data->data as $zip){
            $zipcode = new self;
            $zips[] = $zipcode->parse($zip);
        }

        return $zips;
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
        foreach($data as $key=>$value){
            $this->$key = $value;
        }

        return $this;
    }
}