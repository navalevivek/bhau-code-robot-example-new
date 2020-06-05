<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 12:35 pm
			Purpose : To check the information of an battery...
			Sprint : 1
			Version : I
		*/

namespace App\Power;


use Exception;

/* Information about battery. */
class BatteryPower {

    private $minutesPower;

    private $minutesCharge;

    private $capacity;

    public function __construct(float $minutesPower, float $minutesCharge) {
        $this->minutesPower = $minutesPower;
        $this->minutesCharge = $minutesCharge;
        $this->capacity = 1;
    }

    public function getMaxWorkingTime(): float {
        return $this->minutesPower * $this->capacity;
    }

    public function charge(): float {
        $timeToCharge = $this->minutesCharge * (1 - $this->capacity);
        $this->capacity = 1;
        return $timeToCharge;
    }

    public function work(float $seconds) {
        if ($seconds <= $this->getMaxWorkingTime()) {
            $this->capacity = 1 - ($seconds / $this->minutesPower);
        }
        else {
            throw new Exception('Battery does not have capacity.');
        }
    }

}