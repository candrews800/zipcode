<?php namespace Zipcode;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ZipcodeApi{

    private $config;
    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    protected function __construct(){
        $this->config = include __DIR__ .'/../config.php';
    }

    public function get($zipcode, $distance = false){
        $url = $this->getConfig('api_url');
        $url.= '/get/'.$zipcode;
        $url.= '?api_key=' . $this->getConfig('api_key');

        if($distance){
            $url.= '&embed=near:'.$distance;
        }

        return $this->query($url);
    }

    public function near($zipcode, $distance){
        $url = $this->getConfig('api_url');
        $url.= '/near/' . $zipcode . '/' . $distance;
        $url.= '?api_key=' . $this->getConfig('api_key');

        return $this->query($url);
    }

    public function search($location){
        $url = $this->getConfig('api_url');
        $url.= '/find/' . $location;
        $url.= '?api_key=' . $this->getConfig('api_key');

        return $this->query($url);
    }

    private function query($url){
        echo $url;
        try{
            $client = new Client();
            $res = $client->get($url);
        } catch(RequestException $e){
            if ($e->hasResponse()) {
                return new Response($e->getResponse()->getBody()->getContents());
            }
        }

        return new Response($res->getBody()->getContents());
    }

    public function getConfig($property){
        return $this->config[$property];
    }
}