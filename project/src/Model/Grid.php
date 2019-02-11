<?php

namespace App\Model;

class Grid
{
    private $maxX;
    private $maxY;

    public function getMaxX()
    {
        return $this->maxX;
    }

    public function getMaxY()
    {
        return $this->maxY;
    }

    public function __construct($maxX, $maxY)
    {
        $this->maxX = $maxX;
        $this->maxY = $maxY;
    }
}