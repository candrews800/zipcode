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
        sleep(1);
        $zipcode = new Zipcode(33024);
        $zipcode = $zipcode->get(10);

        foreach($zipcode->near as $nearbyZipcode){
            $nearbyZipcodeList[] = $nearbyZipcode->zipcode;
        }

        $this->assertContains(33328, $nearbyZipcodeList);
    }

    /**
     * @depends testGet
     */
    public function testGetWithInvalidZipcode(){
        sleep(1);
        $zipcode = new Zipcode(123456);

        $this->assertStringStartsWith('Error', $zipcode->get());
    }

    public function testGetNearby(){
        sleep(1);
        $zipcode = new Zipcode(33024);
        $zipcodes = $zipcode->near(10, false);

        $this->assertContains(33328, $zipcodes);
    }

    /**
     * @depends testGetNearby
     */
    public function testGetNearbyWithInvalidZipcode(){
        sleep(1);
        $zipcode = new Zipcode(123456);
        $zipcodes = $zipcode->near(5, false);

        $this->assertStringStartsWith('Error', $zipcodes);
    }

    /**
     * @depends testGetNearby
     */
    public function testGetNearbyWithDetails(){
        sleep(1);
        $zipcode = new Zipcode(33024);
        $zipcodes = $zipcode->near(25, true);

        foreach($zipcodes as $nearbyCity){
            $nearbyCityList[] = $nearbyCity->city;
        }

        $this->assertContains('Pembroke Pines', $nearbyCityList);
    }

    public function testSearchLocation(){
        sleep(1);
        $zipcode = new Zipcode();
        $zipcodes = $zipcode->search('Hollywood, FL');

        foreach($zipcodes as $zip){
            $nearbyZipcodeList[] = $zip->zipcode;
        }

        $this->assertContains(33024, $nearbyZipcodeList);
    }

    public function testGetDistance(){
        sleep(1);
        $zipcode = new Zipcode(33024);
        $distance = $zipcode->distance(33328);

        $this->assertGreaterThan(5, $distance);
        $this->assertLessThan(10, $distance);
    }
}