<?php

declare(strict_types=1);

namespace App\Tests\Model\Orientations;

use App\Model\Orientations\North;
use PHPUnit\Framework\TestCase;

class NorthTest extends TestCase
{
    public function testIsNorthReturnsTrue()
    {
        $orientation = new North();
        $this->assertTrue($orientation->isNorth());
    }

    public function testIsEastReturnsFalse()
    {
        $orientation = new North();
        $this->assertFalse($orientation->isEast());
    }

    public function testIsSouthReturnsFalse()
    {
        $orientation = new North();
        $this->assertFalse($orientation->isSouth());
    }

    public function testIsWestReturnsFalse()
    {
        $orientation = new North();
        $this->assertFalse($orientation->isWest());
    }
}