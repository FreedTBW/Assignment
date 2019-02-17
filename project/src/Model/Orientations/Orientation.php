<?php

declare(strict_types=1);

namespace App\Model\Orientations;

interface Orientation
{
    public function isNorth(): bool;
    public function isEast(): bool;
    public function isSouth(): bool;
    public function isWest(): bool;
    public function serialize(): string;
}
