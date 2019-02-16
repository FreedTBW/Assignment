<?php

declare(strict_types=1);

namespace App\Tests\Model\Orientations;

use App\Model\Orientations\South;
use PHPUnit\Framework\TestCase;

class SouthTest extends TestCase
{
    public function testIsNorthReturnsTrue()
    {
        $orientation = new South();
        $this->assertFalse($orientation->isNorth());
    }

    public function testIsEastReturnsFalse()
    {
        $orientation = new South();
        $this->assertFalse($orientation->isEast());
    }

    public function testIsSouthReturnsFalse()
    {
        $orientation = new South();
        $this->assertTrue($orientation->isSouth());
    }

    public function testIsWestReturnsFalse()
    {
        $orientation = new South();
        $this->assertFalse($orientation->isWest());
    }
}