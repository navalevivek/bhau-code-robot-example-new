<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 13:35 pm
			Purpose : To check whether area cleaned or not...
			Sprint : 1
			Version : I
		*/
		
namespace Tests\Command;


use App\Command\RobotCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Output\Output;

class RobotCommandTest extends TestCase {

    public function testWrongInputs() {
        $inputMock = $this->createMock(Input::class);
        $outputMock = $this->createMock(Output::class);
    
	
        $inputMock->expects($this->any())
            ->method('getOption')
            ->will($this->returnCallback([$this, 'getDataPerParameter']));
        $outputMock->expects($this->at(1))
            ->method("writeln")
            ->will($this->returnCallback([$this, "wrongFloorValue"]));
        $outputMock->expects($this->at(2))
            ->method("writeln")
            ->will($this->returnCallback([$this, "wrongAreaValue"]));
        $robotCommand = new RobotCommand();
        $robotCommand->run($inputMock, $outputMock);
    }

    public function wrongAreaValue(string $areaMessage) {
        $this->assertContains(" - not valid", $areaMessage);
    }

    public function wrongFloorValue(string $floorMessage) {
        $this->assertContains(" - not valid", $floorMessage);
    }

    public function getDataPerParameter(): string {
        $args = func_get_args();
        if ($args[0] === "floor") {
            return "non carpet";
        }
        elseif ($args[0] === "area") {
            return "-20";
        }
    }

}