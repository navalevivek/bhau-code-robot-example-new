<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 14:13 pm
			Purpose : To check whether area cleaned or not...
			Sprint : 1
			Version : I
		*/

namespace Tests\Speed;


use App\Speed\FloorTypeSpeed;
use PHPUnit\Framework\TestCase;

class FloorTypeSpeedTest extends TestCase {

    public function testGetAreaForTime(float $cleaningSpeed, float $time, float$expectedArea) {
        $floorTypeSpeed = new FloorTypeSpeed($cleaningSpeed);
        $area = $floorTypeSpeed->getAreaForTime($time);
        $this->assertSame($expectedArea, $area);
    }

    public function getAreaForTimeProvider(): array {
        return [
            "One meter per one second" => [1.0, 60.0, 60.0],
            "One meter per two seconds" => [0.5, 60.0, 30.0],
        ];
    }

    public function testGetTimeForArea(float $cleaningSpeed, float $area, float $expectedTime) {
        $floorTypeSpeed = new FloorTypeSpeed($cleaningSpeed);
        $time = $floorTypeSpeed->getTimeForArea($area);
        $this->assertSame($expectedTime, $time);
    }

    public function getTimeForAreaProvider(): array {
        return [
            "One meter per one second" => [1.0, 60.0, 60.0],
            "One meter per two seconds" => [0.5, 30.0, 60.0],
        ];
    }
}