<?php

namespace App\Tests\Model;

use App\Model\Rover;
use App\Model\Grid;
use App\Model\Orientations\Orientation;
use App\Model\Orientations\East;
use App\Model\Orientations\North;
use App\Model\Orientations\South;
use App\Model\Orientations\West;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    public function testGetXAxisReturnsInt()
    {
        $rover= new Rover(0, 0, new North(), new Grid(2, 2));
        $this->assertIsInt($rover->getXAxis());
    }

    public function testGetYAxisReturnsInt()
    {
        $rover= new Rover(0, 0, new North(), new Grid(2, 2));
        $this->assertIsInt($rover->getYAxis());
    }

    public function testGetOrientationReturnsOrientation()
    {
        $rover= new Rover(0, 0, new North(), new Grid(2, 2));
        $this->assertInstanceOf(Orientation::class, $rover->getOrientation());
    }

    public function testGetGridReturnsGrid()
    {
        $rover= new Rover(0, 0, new North(), new Grid(2, 2));
        $this->assertInstanceOf(Grid::class, $rover->getGrid());
    }

    public function testTurnRightWhenFacingNorthTurnsRoverRight()
    {
        $rover = new Rover(0, 0, new North(), new Grid(0, 0));

        $alteredRover = $rover->turnRight();
        $this->assertInstanceOf(East::class, $alteredRover->getOrientation());
    }

    public function testTurnRightWhenFacingEastTurnsRoverRight()
    {
        $rover = new Rover(0, 0, new East(), new Grid(0, 0));

        $alteredRover = $rover->turnRight();
        $this->assertInstanceOf(South::class, $alteredRover->getOrientation());

    }

    public function testTurnRightWhenFacingSouthTurnsRoverRight()
    {
        $rover = new Rover(0, 0, new SOUTH, new Grid(0, 0));

        $alteredRover = $rover->turnRight();
        $this->assertInstanceOf(WEST::class, $alteredRover->getOrientation());
    }

    public function testTurnRightWhenFacingWestTurnsRoverRight()
    {
        $rover = new Rover(0, 0, new WEST, new Grid(0, 0));

        $alteredRover = $rover->turnRight();
        $this->assertInstanceOf(NORTH::class, $alteredRover->getOrientation());
    }

    public function testTurnLeftWhenFacingNorthTurnsRoverLeft()
    {
        $rover = new Rover(0,0, new NORTH, new Grid(0,0));

        $alteredRover = $rover->turnLeft();
        $this->assertInstanceOf(WEST::class, $alteredRover->getOrientation());
    }

    public function testTurnLeftWhenFacingWestTurnsRoverLeft()
    {
        $rover = new Rover(0,0, new WEST, new Grid(0,0));

        $alteredRover = $rover->turnLeft();
        $this->assertInstanceOf(SOUTH::class, $alteredRover->getOrientation());
    }

    public function testTurnLeftWhenFacingSouthTurnsRoverLeft()
    {
        $rover = new Rover(0,0, new SOUTH, new Grid(0,0));

        $alteredRover = $rover->turnLeft();
        $this->assertInstanceOf(EAST::class, $alteredRover->getOrientation());
    }

    public function testTurnLeftWhenFacingEastTurnsRoverLeft()
    {
        $rover = new Rover(0,0, new EAST, new Grid(0,0));

        $alteredRover = $rover->turnLeft();
        $this->assertInstanceOf(NORTH::class, $alteredRover->getOrientation());
    }

    public function testMoveSouthToNorthDoesNotCrassRover()
    {
        $rover = new Rover(0,0, new NORTH, new Grid(0,0));

        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getYAxis());
    }

    public function testMoveNorthToSouthDoesNotCrassRover()
    {
        $rover = new Rover(0,0, new SOUTH, new Grid(0,0));

        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getYAxis());
    }

    public function testMoveWestToEastDoesNotCrassRover()
    {
        $rover = new Rover(0,0, new EAST, new Grid(0,0));

        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getXAxis());
    }

    public function testMoveEastToWestDoesNotCrassRover()
    {
        $rover = new Rover(0,0, new WEST, new Grid(0,0));

        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationNorthIncreasesRoverAxisY()
    {
        $rover = new Rover(0,0, new NORTH, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertEquals(1, $alteredRover->getYAxis());
    }

    public function testMoveWithOrientationSouthDecreasesRoverAxisY()
    {
        $rover = new Rover(0,1, new SOUTH, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getYAxis());
    }

    public function testMoveWithOrientationEastIncreasesRoverAxisX()
    {
        $rover = new Rover(0,0, new EAST, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertEquals(1, $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationWestDecreasesRoverAxisX()
    {
        $rover = new Rover(1,0, new WEST, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertEquals(0, $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationNorthAffectOnlyAxisY()
    {
        $rover = new Rover(0,0, new NORTH, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertNotEquals($rover->getYAxis(), $alteredRover->getYAxis());
        $this->assertEquals($rover->getXAxis(), $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationSouthAffectOnlyAxisY()
    {
        $rover = new Rover(0,1, new SOUTH, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertNotEquals($rover->getYAxis(), $alteredRover->getYAxis());
        $this->assertEquals($rover->getXAxis(), $alteredRover->getXAxis());
    }

    public function testMoveWithOrientationEastAffectOnlyAxisX()
    {
        $rover = new Rover(0,0, new EAST, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertNotEquals($rover->getXAxis(), $alteredRover->getXAxis());
        $this->assertEquals($rover->getYAxis(), $alteredRover->getYAxis());
    }

    public function testMoveWithOrientationWestAffectOnlyAxisX()
    {
        $rover = new Rover(1,0, new WEST, new Grid(1,1));
        $alteredRover = $rover->move();
        $this->assertNotEquals($rover->getXAxis(), $alteredRover->getXAxis());
        $this->assertEquals($rover->getYAxis(), $alteredRover->getYAxis());
    }
}