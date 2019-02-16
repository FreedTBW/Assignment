<?php

declare(strict_types=1);

namespace App\Model\Orientations;

use App\Model\Orientation;

class West implements Orientation
{
    public function isNorth(): bool
    {
        return false;
    }

    public function isEast(): bool
    {
        return false;
    }
    public function isSouth(): bool
    {
        return false;
    }

    public function isWest(): bool
    {
        return true;
    }
}