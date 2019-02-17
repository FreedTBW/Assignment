<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Grid;
use App\Model\Instructions;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;

class InstructionsTest extends TestCase
{
    const RAW_TRANSMISSION = <<<input
5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM
input;

    public function testGetTransmissionArrayReturnsArrayContainingStrings()
    {
        $instructions = new Instructions(self::RAW_TRANSMISSION);
        $transmissionArray = $instructions->getTransmissionArray();
        $this->assertIsArray($instructions->getTransmissionArray());
        foreach ($transmissionArray as $transmission) {
            $this->assertIsString($transmission);
        }
    }

    public function testGetGridReturnsGrid()
    {
        $instructions = new Instructions(self::RAW_TRANSMISSION);
        $this->assertInstanceOf(Grid::class, $instructions->getGrid());
    }

    public function testGetInitialRoversReturnsArrayContainingRovers()
    {
        $instructions = new Instructions(self::RAW_TRANSMISSION);
        $roverArray = $instructions->getInitialRovers();
        $this->assertIsArray($roverArray);
        foreach ($roverArray as $rover) {
            $this->assertInstanceOf(Rover::class, $rover);
        }
    }

    public function testGetInstructionsReturnsArrayContainingArraysContainingSingleCharacterStrings()
    {
        $instructions = new Instructions(self::RAW_TRANSMISSION);
        $instructionsArray = $instructions->getInstructions();
        $this->assertIsArray($instructionsArray);
        foreach ($instructionsArray as $roverInstructions) {
            $this->assertIsArray($roverInstructions);
            foreach ($roverInstructions as $instruction) {
                $this->assertIsString($instruction);
                $this->assertEquals(1, strlen($instruction));
            }
        }
    }
}
