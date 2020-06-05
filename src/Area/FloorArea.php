<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 12:25 pm
			Purpose : To check whether area cleaned or not...
			Sprint : 1
			Version : I
		*/

namespace App\Area;

use Exception;

/* Keep data about area that is cleaned and not cleaned */
class FloorArea {

    private $metersSquaredArea;

    private $metersSquaredCleaned;

    public function __construct(float $metersSquaredArea) {
        $this->metersSquaredArea = $metersSquaredArea;
        $this->metersSquaredCleaned = 0;
    }

    public function clean(float $metersSquared): float {
        if ($metersSquared > $this->metersSquaredArea - $this->metersSquaredCleaned) {
            throw new Exception('Hoover would like to clean more meters than it is possible.');
        }
        else {
            $this->metersSquaredCleaned += $metersSquared;
        }
        return $this->metersSquaredArea - $this->metersSquaredCleaned - $metersSquared;
    }

    public function getMaxCleaningArea(): float {
        return $this->metersSquaredArea - $this->metersSquaredCleaned;
    }

    public function isCleaned(): bool {
        return $this->metersSquaredCleaned >= $this->metersSquaredArea;
    }
}