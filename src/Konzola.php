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

    public function color($color)
    {
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
    }

    public function bg($color)
    {
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string ."\e[0m";
    }
}