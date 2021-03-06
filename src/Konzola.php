<?php

namespace Zazalt\Konzola;

class Konzola
{
    protected $string;

    public function __construct($string = null)
    {
        $this->string = $string;
    }

    /**
     * Return the given command
     */
    public function getCommand(): string
    {
        global $argv;
        if(is_array($argv) && count($argv) > 1) {
            return $argv[1];
        }
    }

    /**
     * Return all arguments
     */
    public function getArguments($argumentName = null)
    {
        global $argv;

        if(is_array($argv) && count($argv) > 2) {
            $argumentsList = $this->parseArguments(array_slice($argv, 2));

            if($argumentName) {
                return $argumentsList[$argumentName];
            }

            return $argumentsList;
        }
    }

    /**
     * Parse a list of arguments
     *
     * @param array $arguments
     * @return array
     */
    private function parseArguments(array $arguments): array
    {
        $return = [];
        $args = explode(' -', implode(' ', $arguments));
        foreach ($args as $arg) {
            $arg = ltrim($arg, '-');
            if(strpos($arg, ' ')) {
                list($key, $value) = explode(' ', $arg);
                $return[$key] = $value;
            } else {
                $return[$arg] = true;
            }
        }

        return $return;
    }

    /**
     * Return a specific argument by name
     *
     * @param $argumentName
     * @return string
     */
    public function getArgument(string $argumentName): string
    {
        return $this->getArguments($argumentName);
    }

    public static function text(string $string): Konzola
    {
        return new static($string);
    }

    public $colors = [
        'black' => '0;30',
        'darkGrey' => '1;30',
        'blue'  => '0;34',
        'lightBlue' => '1;34',
        'green' => '0;32',
        'lightGreen' => '1;32',
        'cyan' => '0;36',
        'lightCyan' => '1;36',
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
        'lightCyan' => 47
    ];

    public function color($color)
    {
        $code = $this->colors['green'];
        if(array_key_exists($color, $this->colors)) {
            $code = $this->colors[$color];
        }

        return new static(sprintf('%s%s', "\033[{$code}m", $this->string));
    }

    public function bg($color)
    {
        $code = $this->bgs['black'];
        if(array_key_exists($color, $this->bgs)) {
            $code = $this->bgs[$color];
        }

        $cStyle = addcslashes($this->string, "\0..\37!@\177..\377");
        $found = preg_match_all('/\[(\d);(\d+)m/i', $cStyle, $matches);

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
        echo "Text color:\n";
        foreach ($this->colors as $colorName => $colorCode) {
            echo $this::text($this . " - {$colorName}")->color($colorName)->tabs(1)->lines(1);
        }


        echo "\n\nBackground color:\n";

        foreach ($this->bgs as $bgName => $bgColor) {
            echo $this::text($this . " - {$bgName}")->bg($bgName)->tabs(1)->lines(1);
        }

        echo "\n\nThe rainbow:\n";

        foreach ($this->colors as $colorName => $colorCode) {
            foreach ($this->bgs as $bgName => $bgColor) {
                echo $this->color($colorName)->bg($bgName)->lines(0)->tabs(1);
            }
            echo "\n";
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