<?php

use App\Model\Instructions;
use App\RoverController;

require __DIR__ . '/../vendor/autoload.php';

$transmission = <<<input
5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM
input;

$instructions = new Instructions($transmission);
$roverController = new RoverController($instructions);
$numberOfRovers = $roverController->getNumberOfRovers();
$roversStateHistories = [];
for ($i=0; $i < $numberOfRovers; $i++) {
    $roverStateHistory = $roverController->instructRover($i);
    $lastRoverState = $roverStateHistory->getLastState();
    $serializedState = $lastRoverState->serializeState();
    echo $serializedState . "\n";
}
