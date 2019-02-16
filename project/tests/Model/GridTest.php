<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Grid;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testGetMaxXReturnsInt()
    {
        $grid = new Grid(2,2);
        $this->assertIsInt($grid->getMaxX());
    }

    public function testGetMaxYReturnsInt()
    {
        $grid = new Grid(2,2);
        $this->assertIsInt($grid->getMaxY());
    }
}
