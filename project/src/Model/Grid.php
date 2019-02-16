<?php

declare(strict_types=1);

namespace App\Model;

class Grid
{
    private $maxX;
    private $maxY;

    public function getMaxX(): int
    {
        return $this->maxX;
    }

    public function getMaxY(): int
    {
        return $this->maxY;
    }

    public function __construct(int $maxX, int $maxY)
    {
        $this->maxX = $maxX;
        $this->maxY = $maxY;
    }
}
