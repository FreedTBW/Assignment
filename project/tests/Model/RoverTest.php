<?php

namespace App\Tests\Model;

use App\Constants\Orientation;
use App\Model\Grid;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    public function testTurnRightWhenFacingNorthTurnsRoverRight()
    {
        $rover = new Rover(0, 0, Orientation::NORTH, new Grid(0, 0));

        $alteredRover = $rover->turnRight();
        $this->assertEquals(Orientation::EAST, $alteredRover->getOrientation());
    }

    public function testTurnRightWhenFacingEastTurnsRoverRight()
    {
        $rover = new Rover(0, 0, Orientation::EAST, new Grid(0, 0));

        $alteredRover = $rover->turnRight();
        $this->assertEquals(Orientation::SOUTH, $alteredRover->getOrientation());

    }

    public function testTurnRightWhenFacingSouthTurnsRoverRight()
    {
        $rover = new Rover(0, 0, Orientation::SOUTH, new Grid(0, 0));

        $alteredRover = $rover->turnRight();
        $this->assertEquals(Orientation::WEST, $alteredRover->getOrientation());
    }

    public function testTurnRightWhenFacingWestTurnsRoverRight()
    {
        $rover = new Rover(0, 0, Orientation::WEST, new Grid(0, 0));

        $alteredRover = $rover->turnRight();
        $this->assertEquals(Orientation::NORTH, $alteredRover->getOrientation());
    }

    public function testTurnLeftWhenFacingNorthTurnsRoverLeft()
    {
        $rover = new Rover(0,0, Orientation::NORTH, new Grid(0,0));

        $alteredRover = $rover->turnLeft();
        $this->assertEquals(Orientation::WEST, $alteredRover->getOrientation());
    }

    public function testTurnLeftWhenFacingWestTurnsRoverLeft()
    {
        $rover = new Rover(0,0, Orientation::WEST, new Grid(0,0));

        $alteredRover = $rover->turnLeft();
        $this->assertEquals(Orientation::SOUTH, $alteredRover->getOrientation());
    }

    public function testTurnLeftWhenFacingSouthTurnsRoverLeft()
    {
        $rover = new Rover(0,0, Orientation::SOUTH, new Grid(0,0));

        $alteredRover = $rover->turnLeft();
        $this->assertEquals(Orientation::EAST, $alteredRover->getOrientation());
    }

    public function testTurnLeftWhenFacingEastTurnsRoverLeft()
    {
        $rover = new Rover(0,0, Orientation::EAST, new Grid(0,0));

        $alteredRover = $rover->turnLeft();
        $this->assertEquals(Orientation::NORTH, $alteredRover->getOrientation());
    }

    public function testMoveSouthToNorthDoesNotCrassRover()
    {
        $rover = new Rover(0,0, Orientation::NORTH, new Grid(0,0));

        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getYAxis());
    }

    public function testMoveNorthToSouthDoesNotCrassRover()
    {
        $rover = new Rover(0,0, Orientation::SOUTH, new Grid(0,0));

        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getYAxis());
    }

    public function testMoveWestToEastDoesNotCrassRover()
    {
        $rover = new Rover(0,0, Orientation::EAST, new Grid(0,0));

        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getXAxis());
    }

    public function testMoveEastToWestDoesNotCrassRover()
    {
        $rover = new Rover(0,0, Orientation::WEST, new Grid(0,0));

        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationNorthIncreasesRoverAxisY()
    {
        $rover = new Rover(0,0, Orientation::NORTH, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertEquals(1, $alteredRover->getYAxis());
    }

    public function testMoveWithOrientationSouthDecreasesRoverAxisY()
    {
        $rover = new Rover(0,1, Orientation::SOUTH, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getYAxis());
    }

    public function testMoveWithOrientationEastIncreasesRoverAxisX()
    {
        $rover = new Rover(0,0, Orientation::EAST, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertEquals(1, $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationWestDecreasesRoverAxisX()
    {
        $rover = new Rover(1,0, Orientation::WEST, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationNorthAffectOnlyAxisY()
    {
        $rover = new Rover(0,0, Orientation::NORTH, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertNotEquals($rover->getYAxis(), $alteredRover->getYAxis());
        $this->assertEquals($rover->getXAxis(), $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationSouthAffectOnlyAxisY()
    {
        $rover = new Rover(0,1, Orientation::SOUTH, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertNotEquals($rover->getYAxis(), $alteredRover->getYAxis());
        $this->assertEquals($rover->getXAxis(), $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationEastAffectOnlyAxisX()
    {
        $rover = new Rover(0,0, Orientation::EAST, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertNotEquals($rover->getXAxis(), $alteredRover->getXAxis());
        $this->assertEquals($rover->getYAxis(), $alteredRover->getYAxis());
    }

    public function testMoveWithOrientationWestAffectOnlyAxisX()
    {
        $rover = new Rover(1,0, Orientation::WEST, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertNotEquals($rover->getXAxis(), $alteredRover->getXAxis());
        $this->assertEquals($rover->getYAxis(), $alteredRover->getYAxis());
    }
}