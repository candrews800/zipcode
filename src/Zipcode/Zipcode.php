<?php namespace Zipcode;

class Zipcode{

    private $error;

    public function __construct(){
        if(func_num_args() == 1){
            $this->zipcode = func_get_arg(0);
        }
    }

    public function get($distance = false){
        $api = ZipcodeApi::getInstance();
        $response = $api->get($this->zipcode, $distance);

        if($response->hasError()){
            return $this->setError($response);
        }

        $data = $response->getContent();

        return $this->assembleFrom($data);
    }

    public function near($distance, $details = true){
        $api = ZipcodeApi::getInstance();

        $response = $api->near($this->zipcode, $distance, $details);

        if($response->hasError()){
            return $this->setError($response);
        }

        if( ! $details){
            return $response->getContent();
        }

        $data = $response->getContent();

        return $this->assembleFrom($data);
    }

    public function search($location){
        $api = ZipcodeApi::getInstance();
        $response = $api->search($location);

        if($response->hasError()){
            return $this->setError($response);
        }

        $data = $response->getContent();

        return $this->assembleFrom($data);
    }

    public function getError(){
        return $this->error->getError();
    }

    public function hasError(){
        if($this->error){
            return 1;
        }
        return 0;
    }

    public function setError($response){
        return $this->error = $response;
    }

    public function assembleFrom($data){
        if(is_array($data) && sizeof($data) > 1){
            foreach($data as $zip){
                $zipcode = new self($zip['zipcode']);
                $zips[] = $zipcode->parse($zip);
            }

            return $zips;
        }
        elseif(is_array($data)){
            return $this->parse($data[0]);
        }
        else{
            return $this->parse($data);
        }
    }

    public function distance($zipcode){
        $api = ZipcodeApi::getInstance();
        $response = $api->distance($this->zipcode, $zipcode);

        if($response->hasError()){
            return $response->getError();
        }

        $data = $response->getContent();

        return $data['distance'];
    }

    public function parse($data){
        foreach($data as $key=>$value){
            if($key == 'near'){
                foreach($value as $zip){
                    $zipcode = new self($zip['zipcode']);
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