<?php
require_once is_dir('../vendor/') ? '../vendor/autoload.php' : 'vendor/autoload.php';

$Konzola = new \Zazalt\Konzola\Konzola();

echo $Konzola->getCommand();