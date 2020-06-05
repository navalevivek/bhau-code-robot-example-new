<?php
		/*
			Author : Bhausaheb Navale
			Created Date : 05/06/2020 12:00 pm
			Purpose : To check Command control...
			Sprint : 1
			Version : I
		*/
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Robot\HooverRobot;

/* Command control */
class RobotCommand extends Command {

    public function __construct() {
        parent::__construct();
    }

	protected function configure() {
        $this->setName('clean')
            ->setDescription('Robot for hoovering.')
            ->setHelp('Robot for hoovering that can charge itself.')
            ->addOption(
                'floor',
                NULL,
                InputOption::VALUE_REQUIRED,
                'Type of floor.'
            )
            ->addOption(
                'area',
                NULL,
                InputOption::VALUE_REQUIRED,
                'Area in meter squared.'
            );
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $this->hoover($input, $output);
    }

    protected function hoover(InputInterface $input, OutputInterface $output) {
        $output->writeln([
            '===========**** Hoover App ****===========',
            '==========================================',
            '',
        ]);
        $floor = $input->getOption('floor');
        $area = $input->getOption('area');
        $isFloorValid = $this->isFloorTypeValid($floor);
        $isAreaValid = $this->isAreaValid($area);
        $floorMessage = ($isFloorValid) ? "" : " - not valid";
        $areaMessage = ($isAreaValid) ? "" : " - not valid";

        $output->writeln("floor: " . $floor . $floorMessage);
        $output->writeln("area: " . $area . $areaMessage);
        $output->writeln('==========================================');

        if ($isFloorValid and $isAreaValid) {
            $robot = new HooverRobot($input->getOption('floor'), floatval($input->getOption('area')));
            $tasks = $robot->run();
            foreach ($tasks as $taskType => $taskTime) {
                $output->writeln($taskType . ": " . $taskTime . "s");
                sleep(intval($taskTime));
            }
        }
    }

    private function isFloorTypeValid($floorType) {
        if (array_key_exists($floorType, HooverRobot::FLOOR_TYPES)) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    private function isAreaValid($area) {
        if (is_numeric($area) and $area > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
}