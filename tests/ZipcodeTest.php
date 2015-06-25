<?php

use Zipcode\Zipcode;

class ZipcodeTest extends PHPUnit_Framework_TestCase
{
    public function testGet(){
        $zipcode = new Zipcode(33024);
        $zipcode->get();

        $this->assertEquals(ucfirst(strtolower($zipcode->city)), 'Hollywood');
    }

    /**
     * @depends testGet
     */
    public function testGetWithNear(){
        $zipcode = new Zipcode(33024);
        $zipcode = $zipcode->get(5);

        foreach($zipcode->near as $nearbyZipcode){
            $nearbyZipcodeList[] = $nearbyZipcode->zipcode;
        }

        $this->assertContains(33328, $nearbyZipcodeList);
    }

    /**
     * @depends testGet
     */
    public function testGetWithInvalidZipcode(){
        $zipcode = new Zipcode(123456);

        $this->assertStringStartsWith('Error', $zipcode->get());
    }

    public function testGetNearby(){
        $zipcode = new Zipcode(33024);
        $zipcodes = $zipcode->near(5, false);

        $this->assertContains(33328, $zipcodes);
    }

    /**
     * @depends testGetNearby
     */
    public function testGetNearbyWithDetails(){
        $zipcode = new Zipcode(33024);
        $zipcodes = $zipcode->near(25, true);

        foreach($zipcodes as $nearbyCity){
            $nearbyCityList[] = $nearbyCity->city;
        }

        $this->assertContains('Pembroke Pines', $nearbyCityList);
    }

    public function testSearchLocation(){
        $zipcode = new Zipcode();
        $zipcodes = $zipcode->search('Hollywood, FL');

        foreach($zipcodes as $zip){
            $nearbyZipcodeList[] = $zip->zipcode;
        }

        $this->assertContains(33024, $nearbyZipcodeList);
    }
}