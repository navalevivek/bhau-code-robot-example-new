# hoover

**Installation**

composer install

**Use**

run command 
`$ robot.php clean --floor=carpet --area=70 `
and you see the state when it's cleaning or charging the battery as a command output. 
The --floor parameter can have one of the values _hard_ or _carpet_.

**Tests**

You can run tests by 
`./vendor/bin/phpunit --bootstrap vendor/autoload.php tests`