<?php

namespace App\Tests\Model;

use App\Model\Grid;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    public function testTurnRightTurnsRoverRight()
    {
        $rover = new Rover(0,0, 'N', new Grid(0,0));

        $rover->turnRight();
        $this->assertEquals('E', $rover->getOrientation());

        $rover->turnRight();
        $this->assertEquals('S', $rover->getOrientation());

        $rover->turnRight();
        $this->assertEquals('W', $rover->getOrientation());

        $rover->turnRight();
        $this->assertEquals('N', $rover->getOrientation());
    }

    public function testTurnLeftTurnsRoverLeft()
    {
        $rover = new Rover(0,0, 'N', new Grid(0,0));

        $rover->turnLeft();
        $this->assertEquals('W', $rover->getOrientation());

        $rover->turnLeft();
        $this->assertEquals('S', $rover->getOrientation());

        $rover->turnLeft();
        $this->assertEquals('E', $rover->getOrientation());

        $rover->turnLeft();
        $this->assertEquals('N', $rover->getOrientation());
    }

    public function testMoveDoesNotCrassRover()
    {
        $rover = new Rover(0,0, 'N', new Grid(0,0));

        $rover->move();
        $this->assertEquals(0, $rover->getYAxis());

        $rover->turnRight();
        $rover->move();
        $this->assertEquals(0, $rover->getXAxis());

        $rover->turnRight();
        $rover->move();
        $this->assertEquals(0, $rover->getYAxis());

        $rover->turnRight();
        $rover->move();
        $this->assertEquals(0, $rover->getXAxis());
    }

    public function testMoveMovesRover()
    {
        $rover = new Rover(0,0, 'N', new Grid(1,1));

        $rover->move();
        $this->assertEquals(1, $rover->getYAxis());
        $this->assertEquals(0, $rover->getXAxis());

        $rover->turnRight();
        $rover->move();
        $this->assertEquals(1, $rover->getYAxis());
        $this->assertEquals(1, $rover->getXAxis());

        $rover->turnRight();
        $rover->move();
        $this->assertEquals(0, $rover->getYAxis());
        $this->assertEquals(1, $rover->getXAxis());

        $rover->turnRight();
        $rover->move();
        $this->assertEquals(0, $rover->getYAxis());
        $this->assertEquals(0, $rover->getXAxis());
    }
}