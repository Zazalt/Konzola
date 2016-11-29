<?php
require_once is_dir('../vendor/') ? '../vendor/autoload.php' : 'vendor/autoload.php';

$Konzola = new \Zazalt\Konzola\Konzola();

/**
 * Usage:
 *  php example2.php theCommand -a --b --c lorem -d ipsum
 */
echo 'Given command: '. $Konzola->getCommand() ."\n";
echo '--c argument: '. $Konzola->getArgument('c') ."\n";
echo 'Given arguments: ';
print_r($Konzola->getArguments());