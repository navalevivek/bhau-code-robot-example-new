<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 14:00 pm
			Purpose : To check whether area cleaned or not...
			Sprint : 1
			Version : I
		*/

namespace Tests\Robot;


use App\Robot\HooverRobot;
use PHPUnit\Framework\TestCase;

class HooverRobotTest extends TestCase{

    public function testHoover(string $floorType, float $area, array $expectedTasks){
         $hooverRobot = new HooverRobot($floorType, $area);
         $tasks = $hooverRobot->run();
         $this->assertSame($tasks, $expectedTasks);
     }

    public function getTestHooverProvider(): array {
        return [
            "hard" => ["hard", 60.0, ["hoovering_1" => 60.0, "charging_1" => 30.0]],
            "carpet" => ["carpet", 30.0, ["hoovering_1" => 60.0, "charging_1" => 30.0]]
        ];
    }
}