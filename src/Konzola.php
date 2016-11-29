<?php

namespace Zazalt\Konzola;

class Konzola
{
    protected $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * Return the given command
     */
    public function getCommand()
    {

    }

    /**
     * Return all arguments
     */
    public function getArguments()
    {

    }

    /**
     * Return a specific argument
     *
     * @param $argumentName string
     */
    public function getArgument($argumentName)
    {

    }

    public static function text($string)
    {
        return new static($string);
    }

    public $colors = [
        'black' => '0;30',
        'blue'  => '0;34',
        'lightBlue' => '1;34',
        'green' => '0;32',
        'lightGreen' => '1;32',
        'cyan' => '0;36',
        'red' => '0;31',
        'lightRed' => '1;31',
        'purple' => '0;35',
        'lightPurple' => '1;35',
        'brown' => '0;33',
        'yellow' => '1;33',
        'lightGray' => '0;37',
        'white' => '1;37'
    ];

    public $bgs = [
        'black' => 40,
        'red' => 41,
        'green' => 42,
        'yellow' => 43,
        'blue' => 44,
        'magenta' => 45,
        'cyan' => 46,
        'lightCyan => 47'
    ];

    public function color($color)
    {
        $code = $this->colors['green'];
        if(array_key_exists($color, $this->colors)) {
            $code = $this->colors[$color];
        }

        return new static(sprintf('%s%s', "\033[{$code}m", $this->string));
/*
        switch ($color) {
            case 'black':
                $code = '0;30'; break;

            case 'blue':
                $code = '0;34'; break;

            case 'lightBlue':
                $code = '1;34'; break;

            case 'green':
                $code = '0;32'; break;

            case 'lightGreen':
                $code = '1;32'; break;

            case 'cyan':
                $code = '0;36'; break;

            case 'red':
                $code = '0;31'; break;

            case 'lightRed':
                $code = '1;31'; break;

            case 'purple':
                $code = '0;35'; break;

            case 'lightPurple':
                $code = '1;35'; break;

            case 'brown':
                $code = '0;33'; break;

            case 'yellow':
                $code = '1;33'; break;

            case 'lightGray':
                $code = '0;37'; break;

            case 'white':
                $code = '1;37'; break;

            default:
                $code = '0;30'; break;
        }

        return new static(sprintf('%s%s', "\033[{$code}m", $this->string));
*/
    }

    public function bg($color)
    {
        $code = $this->bgs['black'];
        if(array_key_exists($color, $this->bgs)) {
            $code = $this->bgs[$color];
        }

        /*
        switch ($color) {
            case 'black':
                $code = 40; break;

            case 'red':
                $code = 41; break;

            case 'green':
                $code = 42; break;

            case 'yellow':
                $code = 43; break;

            case 'blue':
                $code = 44; break;

            case 'magenta':
                $code = 45; break;

            case 'cyan':
                $code = 46; break;

            case 'lightCyan':
                $code = 47; break;

            default:
                $code = 40; break;
        }
        */

        $cStyle = addcslashes($this->string, "\0..\37!@\177..\377");
        $found = preg_match_all('/\[(\d);(\d+)m/i', $cStyle, $matches);

        if(0) {
            echo $cStyle ."\n";
            print_r($matches);
            die;
        }

        if($found) {
            $this->string = addcslashes($this->string, "\0..\37!@\177..\377");
            $this->string = str_replace('\033' . $matches[0][0], '', $this->string);

            return new static(sprintf('%s%s', "\e[{$matches[1][0]};{$matches[2][0]}m\e[{$code}m", $this->string));
        }

        return new static(sprintf('%s%s', "\e[{$code}m", $this->string));
    }

    public function bold()
    {
        return new static($this->string);
    }

    public function tabs($number)
    {
        return new static(str_repeat('    ', $number) . $this->string);
    }

    public function lines($number)
    {
        return new static(str_repeat("\n", $number) . $this->string);
    }

    public function rainbow()
    {
        foreach ($this->colors as $colorName => $colorCode) {
            foreach ($this->bgs as $bgName => $bgColor) {
                echo $this->color($colorName)->bg($bgColor)->lines(1);
            }
        }
    }

    /**
     * Return the string and reset the unix-style color
     *
     * @return string
     */
    public function __toString()
    {
        return $this->string ."\e[0m";
    }
}