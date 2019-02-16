<?php

declare(strict_types=1);

namespace App\Model;

use App\Exceptions\NoOrientationException;
use App\Constants\Orientation;

class Rover
{
    private $xAxis;
    private $yAxis;
    private $orientation;
    private $grid;

    public function __construct(
        int $xAxis,
        int $yAxis,
        string $orientation,
        Grid $grid
    )
    {
        $this->xAxis = $xAxis;
        $this->yAxis = $yAxis;
        $this->orientation = $orientation;
        $this->grid = $grid;
    }

    public function getXAxis(): int
    {
        return $this->xAxis;
    }

    public function getYAxis(): int
    {
        return $this->yAxis;
    }

    public function getOrientation(): string
    {
        return $this->orientation;
    }

    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function turnLeft(): self
    {
        switch ($this->orientation){
            case Orientation::NORTH:
                return new self(
                    $this->getXAxis(),
                    $this->getYAxis(),
                    Orientation::WEST,
                    $this->grid
                );
            case Orientation::WEST:
                return new self(
                    $this->getXAxis(),
                    $this->getYAxis(),
                    Orientation::SOUTH,
                    $this->grid
                );
            case Orientation::SOUTH:
                return new self(
                    $this->getXAxis(),
                    $this->getYAxis(),
                    Orientation::EAST,
                    $this->grid
                );
            case Orientation::EAST:
                return new self(
                    $this->getXAxis(),
                    $this->getYAxis(),
                    Orientation::NORTH,
                    $this->grid
                );
            default:
                throw new NoOrientationException();
        }
    }

    public function turnRight()
    {
        switch ($this->orientation){
            case Orientation::NORTH:
                return new self(
                    $this->getXAxis(),
                    $this->getYAxis(),
                    Orientation::EAST,
                    $this->grid
                );
            case Orientation::EAST:
                return new self(
                    $this->getXAxis(),
                    $this->getYAxis(),
                    Orientation::SOUTH,
                    $this->grid
                );
            case Orientation::SOUTH:
                return new self(
                    $this->getXAxis(),
                    $this->getYAxis(),
                    Orientation::WEST,
                    $this->grid
                );
            case Orientation::WEST:
                return new self(
                    $this->getXAxis(),
                    $this->getYAxis(),
                    Orientation::NORTH,
                    $this->grid
                );
            default:
                throw new NoOrientationException();
        }
    }

    public function move(): self
    {
        $xAxis = $this->xAxis;
        $yAxis = $this->yAxis;

        switch ($this->orientation){
            case Orientation::NORTH:
                if ($this->yAxis + 1 <= $this->grid->getMaxY()) {
                    $yAxis = $this->yAxis + 1;
                }

                break;
            case Orientation::SOUTH:
                if ($this->yAxis - 1 >= 0) {
                    $yAxis = $this->yAxis - 1;
                }

                break;
            case Orientation::EAST:
                if ($this->xAxis + 1 <= $this->grid->getMaxX()) {
                    $xAxis = $this->xAxis + 1;
                }

                break;
            case Orientation::WEST:
                if ($this->xAxis - 1 >= 0) {
                    $xAxis = $this->xAxis - 1;
                }

                break;
            default:
                throw new NoOrientationException();
        }

        return new self(
            $xAxis,
            $yAxis,
            $this->orientation,
            $this->grid
        );
    }
}
