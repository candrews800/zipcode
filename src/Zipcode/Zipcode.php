<?php namespace Zipcode;

class Zipcode{

    public static function get($zip, $distance = false){
        $api = ZipcodeApi::getInstance();
        $response = $api->get($zip, $distance);

        if($response->hasError()){
            return $response->getError();
        }

        $data = $response->getContent();

        foreach($data as $zip){
            $zipcode = new self;
            $zips[] = $zipcode->parse($zip);
        }

        return $zips;
    }

    public static function near($zip, $distance){
        $api = ZipcodeApi::getInstance();
        $response = $api->near($zip, $distance);

        if($response->hasError()){
            return $response->getError();
        }

        $data = $response->getContent();

        return $data;

        foreach($data as $zip){
            $zipcode = new self;
            $zips[] = $zipcode->parse($zip);
        }

        return $zips;
    }

    public static function search($location){
        $api = ZipcodeApi::getInstance();
        $response = $api->search($location);

        if($response->hasError()){
            return $response->getError();
        }

        $data = $response->getContent();

        foreach($data as $zip){
            $zipcode = new self;
            $zips[] = $zipcode->parse($zip);
        }

        return $zips;
    }

    public function parse($data){
        foreach($data as $key=>$value){
            if($key == 'near'){
                foreach($value as $zip){
                    $zipcode = new self;
                    $this->near[] = $zipcode->parse($zip);
                }
            }
            else{
                $this->$key = $value;
            }
        }

        return $this;
    }
}