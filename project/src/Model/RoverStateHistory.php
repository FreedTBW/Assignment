<?php

declare(strict_types=1);

namespace App\Model;

use OutOfBoundsException;

class RoverStateHistory
{
    protected $history;

    public function __construct(array $history = null)
    {
        $this->history = [];

        if (isset($history)) {
            $this->history = $history;
        }
    }

    public function getLength(): int
    {
        return sizeof($this->history);
    }

    public function appendStateToHistory(Rover $roverState): RoverStateHistory
    {
        $updatedHistory = $this->history;
        $updatedHistory[] = $roverState;

        return new RoverStateHistory($updatedHistory);
    }

    public function getState(int $index): Rover
    {
        if ($index >= sizeof($this->history)){
            throw new OutOfBoundsException();
        }

        return $this->history[$index];
    }

    public function getLastState(): Rover
    {
        return $this->history[sizeof($this->history) - 1];
    }
}
