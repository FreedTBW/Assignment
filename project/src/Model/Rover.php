<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Orientations\Orientation;
use App\Model\Orientations\East;
use App\Model\Orientations\North;
use App\Model\Orientations\South;
use App\Model\Orientations\West;


class Rover
{
    private $xAxis;
    private $yAxis;
    private $orientation;
    private $grid;

    public function __construct(
        int $xAxis,
        int $yAxis,
        Orientation $orientation,
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

    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }

    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function turnLeft(): self
    {
        $orientation = $this->orientation;

        if ($this->orientation->isNorth()) {
            $orientation = new West();
        }

        if ($this->orientation->isWest()) {
            $orientation = new South();
        }

        if ($this->orientation->isSouth()) {
            $orientation = new East();
        }

        if ($this->orientation->isEast()) {
            $orientation = new North();
        }

        return new self(
            $this->getXAxis(),
            $this->getYAxis(),
            $orientation,
            $this->grid
        );
    }

    public function turnRight(): self
    {
        $orientation = $this->orientation;

        if ($this->orientation->isNorth()) {
            $orientation = new East();
        }

        if ($this->orientation->isEast()) {
            $orientation = new South();
        }

        if ($this->orientation->isSouth()) {
            $orientation = new West();
        }

        if ($this->orientation->isWest()) {
            $orientation = new North();
        }

        return new self(
            $this->getXAxis(),
            $this->getYAxis(),
            $orientation,
            $this->grid
        );
    }

    public function move(): self
    {
        $xAxis = $this->xAxis;
        $yAxis = $this->yAxis;

        if ($this->orientation->isNorth()) {
            if ($this->yAxis + 1 <= $this->grid->getMaxY()) {
                $yAxis = $this->yAxis + 1;
            }
        }

        if ($this->orientation->isEast()) {
            if ($this->xAxis + 1 <= $this->grid->getMaxX()) {
                $xAxis = $this->xAxis + 1;
            }
        }

        if ($this->orientation->isSouth()) {
            if ($this->yAxis - 1 >= 0) {
                $yAxis = $this->yAxis - 1;
            }
        }

        if ($this->orientation->isWest()) {
            if ($this->xAxis - 1 >= 0) {
                $xAxis = $this->xAxis - 1;
            }
        }

        return new self(
            $xAxis,
            $yAxis,
            $this->orientation,
            $this->grid
        );
    }

    public function serializeState(): string
    {
        return $this->xAxis . ' ' .
        $this->yAxis . ' ' .
        $this->orientation->serialize();
    }
}
