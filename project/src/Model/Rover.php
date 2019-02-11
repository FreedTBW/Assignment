<?php

namespace App\Model;

class Rover
{
    private $xAxis;
    private $yAxis;
    private $orientation;
    private $grid;

    const NORTH = 'N';
    const SOUTH = 'S';
    const EAST = 'E';
    const WEST = 'W';

    public function __construct($xAxis, $yAxis, $orientation, $grid)
    {
        $this->xAxis = $xAxis;
        $this->yAxis = $yAxis;
        $this->orientation = $orientation;
        $this->grid = $grid;
    }

    public function getXAxis()
    {
        return $this->xAxis;
    }

    public function getYAxis()
    {
        return $this->yAxis;
    }

    public function getOrientation()
    {
        return $this->orientation;
    }

    public function turnLeft()
    {
        switch ($this->orientation){
            case self::NORTH:
                $this->orientation = self::WEST;
                break;
            case self::SOUTH:
                $this->orientation = self::EAST;
                break;
            case self::EAST:
                $this->orientation = self::NORTH;
                break;
            case self::WEST:
                $this->orientation = self::SOUTH;
                break;
        }
    }

    public function turnRight()
    {
        switch ($this->orientation){
            case self::NORTH:
                $this->orientation = self::EAST;
                break;
            case self::SOUTH:
                $this->orientation = self::WEST;
                break;
            case self::EAST:
                $this->orientation = self::SOUTH;
                break;
            case self::WEST:
                $this->orientation = self::NORTH;
                break;
        }
    }

    public function move()
    {
        switch ($this->orientation){
            case self::NORTH:
                if ($this->yAxis + 1 > $this->grid->getMaxY()){
                    break;
                }
                $this->yAxis += 1;
                break;
            case self::SOUTH:
                if ($this->yAxis - 1 < 0){
                    break;
                }
                $this->yAxis -= 1;
                break;
            case self::EAST:
                if ($this->xAxis + 1 > $this->grid->getMaxX()){
                    break;
                }
                $this->xAxis += 1;
                break;
            case self::WEST:
                if ($this->xAxis - 1 < 0){
                    break;
                }
                $this->xAxis -= 1;
                break;
        }
    }
}
