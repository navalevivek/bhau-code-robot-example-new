<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 13:50 pm
			Purpose : To check whether area cleaned or not...
			Sprint : 1
			Version : I
		*/
		
namespace Tests\Power;


use App\Power\BatteryPower;
use PHPUnit\Framework\TestCase;
use Exception;

class BatteryPowerTest extends TestCase {

    public function testWork(float $minutesPower, float $workTime, float $expectedMinutesCapacity) {
        $batteryPower = new BatteryPower($minutesPower, 0);
        $batteryPower->work($workTime);
        $minutesCapacity = $batteryPower->getMaxWorkingTime();
        $this->assertSame($expectedMinutesCapacity, $minutesCapacity);
    }

    public function getTestWorkProvider(): array {
        return [
            "Half battery after work" => [60.0, 30.0, 30.0],
            "Empty battery after work" => [60.0, 60.0, 0.0],
        ];
    }

    public function testCharge(float $minutesPower, float $workTime, float $minutesCharge, float $expectedMinutesCharge) {
        $batteryPower = new BatteryPower($minutesPower, $minutesCharge);
        $batteryPower->work($workTime);
        $minutesCharge = $batteryPower->charge();
        $this->assertSame($expectedMinutesCharge, $minutesCharge);
    }

    public function getTestChargeProvider(): array {
        return [
            "Half battery after work" => [60.0, 30.0, 30.0, 15.0],
            "Empty battery after work" => [60.0, 60.0, 30.0, 30.0],
            "Full battery after work" => [60.0, 0.0, 30.0, 0.0],
        ];
    }

    public function testWorkMoreThanCapacity() {
        $batteryPower = new BatteryPower(60, 30);
        $this->expectException(Exception::class);
        $batteryPower->work(61);
    }
}