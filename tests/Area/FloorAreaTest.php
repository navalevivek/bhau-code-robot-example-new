<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 13:15 pm
			Purpose : To test the algorithm for cleaning...
			Sprint : 1
			Version : I
		*/
		
namespace Area;

use PHPUnit\Framework\TestCase;
use App\Area\FloorArea;
use Exception;

class FloorAreaTest extends TestCase {

    public function testClean(float $metersSquaredArea, float $clean, float $expectedMaxCleaningArea, bool $expectedIsCleaned) {
        $floorArea = new FloorArea($metersSquaredArea);
        $floorArea->clean($clean);
        $maxCleaningArea = $floorArea->getMaxCleaningArea();
        $isCleaned = $floorArea->isCleaned();
        $this->assertSame($expectedMaxCleaningArea, $maxCleaningArea);
        $this->assertSame($expectedIsCleaned, $isCleaned);
    }

   public function getCleaningProvider(): array {
        return [
            "Basic subtraction" => [70.0, 30.0, 40.0, false],
            "Clean whole area" => [30.0, 30.0, 0.0, true],
            "Zero area" => [0.0, 0.0, 0.0, true],
            "Float subtraction" => [0.8, 0.1, 0.7, false],
        ];
    }

   public function testCleanMoreThanPossible() {
        $floorArea = new FloorArea(10);
        $this->expectException(Exception::class);
        $floorArea->clean(20);
    }
}