<?php

namespace App;

use App\Exceptions\InvalidGeneralInstructionException;
use App\Model\Grid;
use App\Model\Instructions;
use App\Model\Rover;
use App\Model\RoverStateHistory;

class RoverController
{
    protected $grid;
    protected $rovers;
    protected $instructions;
    protected $numberOfRovers;

    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function getRovers(): array
    {
        return $this->rovers;
    }

    public function getInstructions(): array
    {
        return $this->instructions;
    }

    public function getNumberOfRovers(): int
    {
        return $this->numberOfRovers;
    }

    public function __construct(Instructions $instructions)
    {
        $this->grid = $instructions->getGrid();
        $this->rovers = $instructions->getInitialRovers();
        $this->instructions = $instructions->getInstructions();
        $this->numberOfRovers = sizeof($this->rovers);
    }

    public function instructRover(int $index): RoverStateHistory
    {
        return  $this->followInstructions(
            $this->rovers[$index],
            $this->instructions[$index]
        );
    }

    protected function followInstructions(
        Rover $rover,
        array $instructionsArray
    ): RoverStateHistory
    {
        $roverStateHistory = new RoverStateHistory();
        $updatedRoverStateHistory = $roverStateHistory->appendStateToHistory(
            $rover
        );
        foreach ($instructionsArray as $key => $instruction) {
            $lastRoverState = $updatedRoverStateHistory->getState($key);
            $instructedRover = $this->followInstruction(
                $instruction,
                $lastRoverState
            );
            $updatedRoverStateHistory =
                $updatedRoverStateHistory->appendStateToHistory(
                    $instructedRover
                );
        }

        return $updatedRoverStateHistory;
    }

    protected function followInstruction(string $instruction, Rover $rover): Rover
    {
        switch ($instruction){
            case 'M':
                $alteredRover = $rover->move();
                break;
            case 'L':
                $alteredRover = $rover->turnLeft();
                break;
            case 'R':
                $alteredRover = $rover->turnRight();
                break;
            default:
                throw new InvalidGeneralInstructionException();
        }

        return $alteredRover;
    }
}
