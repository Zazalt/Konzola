<?php

namespace Zazalt\Konzola;

class Konsola
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

    public function text($string)
    {
        return new static($string);
    }

    public function color($color)
    {
        switch ($color) {
            case 'black':
                $code = 30; break;

            case 'blue':
                $code = 34; break;

            case 'green':
                $code = 32; break;

            case 'cyan':
                $code = 36; break;

            case 'red':
                $code = 31; break;

            default:
                $code = 0; break;
        }

        return new static(sprintf('%s %s %s', "\e[{$code}m", $this->string, "\e[0m"));
    }

    public function bg($color)
    {
        switch ($color) {
            case 'red':
                $code = 41; break;

            case 'black':
            default:
                $code = 30; break;
        }

        return new static(sprintf('%s %s %s', "\e[{$code}m", $this->string, "\e[0m"));
    }

    public function bold()
    {
        return new static($this->string);
    }

    public function tabs($number)
    {
        return new static(str_repeat('    ', $number) . $this->string);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }
}