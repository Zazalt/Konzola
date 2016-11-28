<?php

namespace Zazalt\Konzola\Tests;

class KonzolaTest extends \Zazalt\Konzola\Tests\ZazaltTest
{
    protected $that;

    public function __construct()
    {
        parent::loader($this, []);
    }

    public function testColors()
    {
        $this->assertEquals(
            \Zazalt\Konzola\Konzola::text('caca')->color('yellow')->bg('green')->tabs(0)->lines(1),
            \Zazalt\Konzola\Konzola::text('caca')->bg('green')->color('yellow')->tabs(0)->lines(1)
        );
    }
}