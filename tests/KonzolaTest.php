<?php

namespace Zazalt\Konzola\Tests;

use Zazalt\Konzola\Konzola;

class KonzolaTest extends \Zazalt\Konzola\Tests\ZazaltTest
{
    protected $that;

    public function __construct()
    {
        parent::loader($this, []);
    }

    public function testColors()
    {
        $Konzola = new Konzola('test');

        foreach ($Konzola->colors as $colorName => $colorCode) {
            foreach ($Konzola->bgs as $bgName => $bgColor) {
                $tabs = mt_rand(0, 5);

                // Test reversed order parameter
                $this->assertEquals(
                    $Konzola->color($colorName)->bg($bgColor)->tabs($tabs),
                    $Konzola->bg($bgColor)->color($colorName)->tabs($tabs)
                );
            }
        }
    }
}