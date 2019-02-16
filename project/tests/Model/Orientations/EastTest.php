<?php

declare(strict_types=1);

namespace App\Tests\Model\Orientations;

use App\Model\Orientations\East;
use PHPUnit\Framework\TestCase;

class EastTest extends TestCase
{
    public function testIsNorthReturnsTrue()
    {
        $orientation = new East();
        $this->assertFalse($orientation->isNorth());
    }

    public function testIsEastReturnsFalse()
    {
        $orientation = new East();
        $this->assertTrue($orientation->isEast());
    }

    public function testIsSouthReturnsFalse()
    {
        $orientation = new East();
        $this->assertFalse($orientation->isSouth());
    }

    public function testIsWestReturnsFalse()
    {
        $orientation = new East();
        $this->assertFalse($orientation->isWest());
    }
}