<?php namespace Zipcode;

class Zipcode{

    public static function get($zip, $distance = false){
        $api = ZipcodeApi::getInstance();
        $response = $api->get($zip, $distance);

        if($response->hasError()){
            return $response->getError();
        }

        $data = $response->getContent();

        return Zipcode::assembleFrom($data);
    }

    public static function near($zip, $distance, $details = true){
        $api = ZipcodeApi::getInstance();

        $response = $api->near($zip, $distance, $details);

        if($response->hasError()){
            return $response->getError();
        }

        if( ! $details){
            return $response->getContent();
        }

        $data = $response->getContent();

        return Zipcode::assembleFrom($data);
    }

    public static function search($location){
        $api = ZipcodeApi::getInstance();
        $response = $api->search($location);

        if($response->hasError()){
            return $response->getError();
        }

        $data = $response->getContent();

        return Zipcode::assembleFrom($data);
    }

    public static function assembleFrom($data){
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