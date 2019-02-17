<?php

declare(strict_types=1);

namespace App\Model\Orientations;

class North implements Orientation
{
    public function isNorth(): bool
    {
        return true;
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
        return false;
    }

    public function serialize(): string
    {
        return 'N';
    }
}
