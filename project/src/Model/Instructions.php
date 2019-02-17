<?php

declare(strict_types=1);

namespace App\Model;

use App\Exceptions\InvalidOrientationInstructionException;
use App\Model\Orientations\East;
use App\Model\Orientations\North;
use App\Model\Orientations\South;
use App\Model\Orientations\West;

class Instructions
{
    const SPACE_CHARACTER_STRING = ' ';

    protected $transmissionArray;
    protected $grid;
    protected $initialRovers = [];
    protected $instructions = [];

    public function getTransmissionArray(): array
    {
        return $this->transmissionArray;
    }

    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function getInitialRovers(): array
    {
        return $this->initialRovers;
    }

    public function getInstructions(): array
    {
        return $this->instructions;
    }

    public function __construct(string $rawTransmission)
    {
        $transmissionArray = explode("\n", $rawTransmission);
        $this->transmissionArray = $transmissionArray;
        $this->grid = $this->initiateGrid($transmissionArray[0]);

        for ($i=1; $i < sizeof($transmissionArray); $i+=2){
            $this->initialRovers[] = $this->initiateRover($transmissionArray[$i]);
            $this->instructions[] = $this->initiateInstructions(
                $transmissionArray[$i + 1]
            );

        }
    }

    protected function initiateGrid($rawGrid): Grid
    {
        $gridArray = explode(self::SPACE_CHARACTER_STRING, $rawGrid);
        return new Grid((int)$gridArray[0], (int)$gridArray[1]);
    }

    protected function initiateRover($rawPosition)
    {
        $positionArray = explode(
            self::SPACE_CHARACTER_STRING,
            $rawPosition
        );

        switch ($positionArray[2]) {
            case 'N':
                $orientation = new North();
                break;
            case 'E':
                $orientation = new East();
                break;
            case 'S':
                $orientation = new South();
                break;
            case 'W':
                $orientation = new West();
                break;
            default:
                throw new InvalidOrientationInstructionException();
        }

        return new Rover(
            (int)$positionArray[0],
            (int)$positionArray[1],
            $orientation,
            $this->grid
        );
    }

    protected function initiateInstructions($rawInstructions): array
    {
        return str_split($rawInstructions);
    }
}