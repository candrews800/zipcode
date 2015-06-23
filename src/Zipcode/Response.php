<?php namespace Zipcode;

class Response{
    private $content;

    public function __construct($content){
        $this->content = json_decode($content, true);
    }

    public function hasError(){
        if(isset($this->content['error'])){
            return true;
        }
        return false;
    }

    public function getError(){
        return 'Error: ' . $this->content['error']['code'] . ' - ' . $this->content['error']['message'];
    }

    public function getContent(){
        if( ! $this->hasError()){
            return $this->content['data'];
        }
        return $this->getError();
    }
}