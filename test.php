<?php

$start = microtime(true); $memory = memory_get_usage();
session_start();

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
require 'vendor/autoload.php';

\Zazalt\Konzola\Konzola::text('This is a rainbow.')->rainbow();

die;

echo \Zazalt\Konzola\Konzola::text('caca')->color('yellow')->bg('green')->tabs(0)->lines(0);
echo \Zazalt\Konzola\Konzola::text('caca')->bg('green')->color('yellow')->tabs(0)->lines(1);