Konzola
=================

[![Build Status](https://travis-ci.org/Zazalt/Konzola.svg?branch=master)](https://travis-ci.org/Zazalt/Konzola)
[![Coverage Status](https://coveralls.io/repos/github/Zazalt/Konzola/badge.svg?branch=master)](https://coveralls.io/github/Zazalt/Konzola?branch=master)
[![Code Climate](https://codeclimate.com/github/Zazalt/Konzola/badges/gpa.svg)](https://codeclimate.com/github/Zazalt/Konzola)
[![Issue Count](https://codeclimate.com/github/Zazalt/Konzola/badges/issue_count.svg)](https://codeclimate.com/github/Zazalt/Konzola/issues)
[![Total Downloads](https://poser.pugx.org/zazalt/konzola/downloads)](https://packagist.org/packages/zazalt/konzola/stats)
[![Latest Stable Version](https://poser.pugx.org/zazalt/konzola/v/stable)](https://packagist.org/packages/zazalt/konzola)
![Version](https://img.shields.io/badge/version-beta-yellow.svg)



Requirements
---------------
* php >= 7.1.0

Packagist Dependencies
---------------
* None

Installation
---------------
With composer:
``` json
{
	"require": {
		"zazalt/konzola": "dev-master"
	}
}
```

## Usage
```php
require_once is_dir('../vendor/') ? '../vendor/autoload.php' : 'vendor/autoload.php';

\Zazalt\Konzola\Konzola::text('This is a rainbow.')->rainbow();
```
```php
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
```