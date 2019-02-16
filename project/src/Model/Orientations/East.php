<?php

declare(strict_types=1);

namespace App\Model\Orientations;

use App\Model\Orientation;

class East implements Orientation
{
    public function isNorth(): bool
    {
        return false;
    }

    public function isEast(): bool
    {
        return true;
    }
    public function isSouth(): bool
    {
        return false;
    }

    public function isWest(): bool
    {
        return false;
    }
}