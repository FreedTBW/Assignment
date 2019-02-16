<?php

declare(strict_types=1);

namespace App\Model\Orientations;

class South implements Orientation
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
        return true;
    }

    public function isWest(): bool
    {
        return false;
    }
}
