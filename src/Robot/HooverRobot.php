<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 12:50 pm
			Purpose : To check the prices of each batteries...
			Sprint : 1
			Version : I
		*/
		
namespace App\Robot;

use App\Area\FloorArea;
use App\Speed\FloorTypeSpeed;
use App\Power\BatteryPower;

/* All pieces of robot together. */
class HooverRobot {

    const FLOOR_TYPES = ['hard' => 1, 'carpet' => 0.5];
	
	const MINUTES_POWER = 60;

    const MINUTES_CHARGE = 30;

    private $floorArea;

    private $floorTypeSpeed;
	
    private $batteryPower;

    public function __construct(string $floorType, float $area) {
        $this->floorArea = new FloorArea($area);
        $this->floorTypeSpeed = new FloorTypeSpeed($this::FLOOR_TYPES[$floorType]);
        $this->batteryPower = new BatteryPower($this::MINUTES_POWER, $this::MINUTES_CHARGE);
    }

    public function run(): array {
        $tasks = [];
        $i = 0;
        while (TRUE) {
            $i++;
            [
                $area,
                $cleaningTime,
            ] = $this->getCleaningAreaTime();
    
            $this->floorArea->clean($area);
            $this->batteryPower->work($cleaningTime);
            $tasks["hoovering_" . $i] = $cleaningTime;
            //Charge
            $timeToCharge = $this->batteryPower->charge();
            $tasks["charging_" . $i] = $timeToCharge;
            if ($this->floorArea->isCleaned()) {
                break;
            }
        }
        return $tasks;
    }
	
	private function getCleaningAreaTime() {
        $maxWorkingTime = $this->batteryPower->getMaxWorkingTime();
        $maxCleaningArea = $this->floorArea->getMaxCleaningArea();
        $areaToCleanInMaxTime = $this->floorTypeSpeed->getAreaForTime($maxWorkingTime);
        $maxCleaningAreaTime = $this->floorTypeSpeed->getTimeForArea($maxCleaningArea);
        $minArea = min($areaToCleanInMaxTime, $maxCleaningArea);
        $minCleaningTime = min($maxWorkingTime, $maxCleaningAreaTime);
        return [$minArea, $minCleaningTime];
    }

}