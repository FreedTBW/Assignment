<?php

declare(strict_types=1);

namespace App\Model;

interface Orientation
{
    public function isNorth(): bool;
    public function isEast(): bool;
    public function isSouth(): bool;
    public function isWest(): bool;
}