<?php

namespace Agi;

class Colorizer
{

    /**
     * @var array
     */
    protected $colors;

    /**
     * Colorizer constructor.
     */
    public function __construct()
    {
        $this->colors['reset']    = "\e[0m";
        $this->colors['black']    = "\e[0;30m";
        $this->colors['red']      = "\e[0;31m";
        $this->colors['green']    = "\e[0;32m";
        $this->colors['yellow']   = "\e[0;93m";
        $this->colors['blue']     = "\e[0;34m";
        $this->colors['purple']   = "\e[0;35m";
        $this->colors['cyan']     = "\e[0;36m";
        $this->colors['white']    = "\e[0;37m";
    }

    /**
     * Relpaces color tags with ansi colors codes
     *
     * @param string $message
     * @return string
     */
    public function parse(string $message)
    {
        $colorMatchExpression = '/<(?<tag>\\w+)>/';

        $previousColor = $this->colors['reset'];

        // Find all color tags
        preg_match_all($colorMatchExpression, $message, $matches);

        // Replace each color tag
        foreach ($matches['tag'] as $colorTag) {
            if (isset($this->colors[$colorTag])) {
                // Replace Initial tag with desired color
                $message = preg_replace('/<' . $colorTag . '>/', $this->colors[$colorTag], $message, 1);
                // Replace finish tag with previous color
                $message = preg_replace('/<\/' . $colorTag . '>/', $previousColor, $message, 1);
                // Reset previous color
                $previousColor = $this->colors[$colorTag];
            }
        }

        return $message;
    }
}
