<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Grid;
use App\Model\Orientations\North;
use App\Model\Rover;
use App\Model\RoverStateHistory;
use PHPUnit\Framework\TestCase;

class RoverStateHistoryTest extends TestCase
{
    public function testGetLengthReturnsCorrectInt()
    {
        $roverHistory = new RoverStateHistory();

        for ($i=1; $i < 5; $i++) {
            $roverHistory = $roverHistory->appendStateToHistory(new Rover(
                $i,
                $i,
                new North(),
                new Grid($i+1,$i+1)
            ));
        }

        $this->assertIsInt($roverHistory->getLength());
        $this->assertEquals(4, $roverHistory->getLength());
    }

    public function testGetStateReturnsCorrectState()
    {
        $roverHistory = new RoverStateHistory();

        for ($i=1; $i < 5; $i++) {
            $roverHistory = $roverHistory->appendStateToHistory(new Rover(
                $i,
                $i,
                new North(),
                new Grid($i+1,$i+1)
            ));
        }

        $this->assertEquals($roverHistory->getState(2), new Rover(
            3,
            3,
            new North(),
            new Grid(4,4)
        ));
    }

    public function testAppendStateToHistoryReturnsRoverStateHistory()
    {
        $roverHistory = new RoverStateHistory();
        $updatedHistory = $roverHistory->appendStateToHistory(new Rover(
            1,
            1,
            new North(),
            new Grid(2,2)
        ));
        $this->assertInstanceOf(RoverStateHistory::class, $updatedHistory);
    }

    public function testAppendStateToHistoryAddsStateToEndOfHistory()
    {
        $roverHistory = new RoverStateHistory();
        $stateToAppend = new Rover(
            1,
            1,
            new North(),
            new Grid(2,2)
        );
        $updatedHistory = $roverHistory->appendStateToHistory($stateToAppend);
        $numberOfStates = $updatedHistory->getLength();
        $this->assertEquals(
            $stateToAppend,
            $updatedHistory->getState($numberOfStates-1)
        );
    }

    public function testGetLastStateReturnsLastEntry()
    {
        $roverHistory = new RoverStateHistory();

        for ($i=1; $i < 5; $i++) {
            $roverHistory = $roverHistory->appendStateToHistory(new Rover(
                $i,
                $i,
                new North(),
                new Grid($i+1,$i+1)
            ));
        }

        $lastEntry = new Rover(
            4,
            4,
            new North(),
            new Grid(5,5)
        );

        $this->assertEquals($lastEntry, $roverHistory->getLastState());
    }
}
