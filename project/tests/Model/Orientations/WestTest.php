<?php

declare(strict_types=1);

namespace App\Tests\Model\Orientations;

use App\Model\Orientations\West;
use PHPUnit\Framework\TestCase;

class WestTest extends TestCase
{
    public function testIsNorthReturnsTrue()
    {
        $orientation = new West();
        $this->assertFalse($orientation->isNorth());
    }

    public function testIsEastReturnsFalse()
    {
        $orientation = new West();
        $this->assertFalse($orientation->isEast());
    }

    public function testIsSouthReturnsFalse()
    {
        $orientation = new West();
        $this->assertFalse($orientation->isSouth());
    }

    public function testIsWestReturnsFalse()
    {
        $orientation = new West();
        $this->assertTrue($orientation->isWest());
    }
}