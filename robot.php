/** robot.php **/
#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Console\Application;
use App\Command\RobotCommand;

$app = new Application('Robot App', 'v1.0.0');
$app -> add(new RobotCommand());
$app->run();
