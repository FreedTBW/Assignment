<?php

namespace App;

use App\Model\Rover;

class Instructions
{
    private $grid;
    private $rovers;

    public function getGrid()
    {
        return $this->grid;
    }

    public function getRovers()
    {
        return $this->rovers;
    }

    public function __construct($instructions)
    {
        $this->rovers = [];
        if (!empty($instructions)){
            $this->grid = $instructions[0];

            for ($i=1; $i<sizeof($instructions); $i+=2){
                $rover = $this->initRover($instructions[$i]);
                $this->followInstructions($instructions[$i + 1], $rover);
                $this->rovers[] = $rover;
            }
        }
    }

    public function setGrid($grid)
    {
        $this->grid = $grid;
    }

    public function initRover($position)
    {
        $positionArray = explode(' ', $position);

        return new Rover((int)$positionArray[0], (int)$positionArray[1], $positionArray[2], $this->grid);
    }

    public function followInstructions($instructions, $rover)
    {
        $instructionsArray = str_split($instructions);
        foreach ($instructionsArray as $instruction){
            switch ($instruction){
                case 'M':
                    $rover->move();
                    break;
                case 'L':
                    $rover->turnLeft();
                    break;
                case 'R':
                    $rover->turnRight();
                    break;
            }
        }
    }
}