<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 13:05 pm
			Purpose : To check the speed of hoovering based on the floor type...
			Sprint : 1
			Version : I
		*/
		
namespace App\Speed;

/* Speed of hoovering based on floor type.*/
class FloorTypeSpeed {

    private $cleaningSpeed;

    public function __construct(float $cleaningSpeed) {
        $this->cleaningSpeed = $cleaningSpeed;
    }

    public function getAreaForTime(float $seconds): float {
        return $seconds * $this->cleaningSpeed;
    }

    public function getTimeForArea(float $metersSquaredArea): float {
        return $metersSquaredArea / $this->cleaningSpeed;
    }

}