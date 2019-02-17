<?php

declare(strict_types=1);

namespace App\Tests;

use App\Model\Grid;
use App\Model\Instructions;
use App\Model\Orientations\North;
use App\Model\Orientations\South;
use App\Model\Orientations\West;
use App\Model\Rover;
use App\Model\RoverStateHistory;
use App\RoverController;
use PHPUnit\Framework\TestCase;

class RoverControllerTest extends TestCase
{
    const RAW_TRANSMISSION = <<<input
5 5
1 2 N
LML
input;

    public function testGetGridReturnsGrid()
    {
        $controller = new RoverController(
            new Instructions(self::RAW_TRANSMISSION)
        );
        $this->assertInstanceOf(Grid::class, $controller->getGrid());
    }

    public function testGetRoversReturnsArrayContainingRovers()
    {
        $controller = new RoverController(
            new Instructions(self::RAW_TRANSMISSION)
        );
        $roverArray = $controller->getRovers();
        $this->assertIsArray($roverArray);
        foreach ($roverArray as $rover) {
            $this->assertInstanceOf(Rover::class, $rover);
        }
    }

    public function testGetInstructionsReturnsArrayContainingArraysContainingSingleCharacterStrings()
    {
        $controller = new RoverController(
            new Instructions(self::RAW_TRANSMISSION)
        );
        $instructionsArray = $controller->getInstructions();
        $this->assertIsArray($instructionsArray);
        foreach ($instructionsArray as $roverInstructions) {
            $this->assertIsArray($roverInstructions);
            foreach ($roverInstructions as $instruction) {
                $this->assertIsString($instruction);
                $this->assertEquals(1, strlen($instruction));
            }
        }
    }

    public function testGetNumberOfRoversReturnsCorrectInt()
    {
        $controller = new RoverController(
            new Instructions(self::RAW_TRANSMISSION)
        );
        $numberOfRovers = $controller->getNumberOfRovers();
        $this->assertIsInt($numberOfRovers);
        $this->assertEquals(1, $numberOfRovers);
    }

    public function testInstructRoverReturnsCorrectRoverStateHistory()
    {
        $controller = new RoverController(
            new Instructions(self::RAW_TRANSMISSION)
        );
        $instructedRoverHistory = $controller->instructRover(0);
        $this->assertInstanceOf(
            RoverStateHistory::class,
            $instructedRoverHistory
        );
        $expectedRoverHistory = new RoverStateHistory([
            new Rover(
                1,
                2,
                new North(),
                new Grid(5, 5)
            ),
            new Rover(
                1,
                2,
                new West(),
                new Grid(5, 5)
            ),
            new Rover(
                0,
                2,
                new West(),
                new Grid(5, 5)
            ),
            new Rover(
                0,
                2,
                new South(),
                new Grid(5, 5)
            )
        ]);
        $this->assertEquals($expectedRoverHistory, $instructedRoverHistory);
    }
}
