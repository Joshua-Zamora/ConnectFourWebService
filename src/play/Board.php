<?php

class Board
{
    public $board;

    function __construct() {
        $this->board = array(
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0)
        );
    }

    function insertDisc($xCoordinate, $player) {
        for ($yCoordinate = 5; $yCoordinate > -1; $yCoordinate--) {
            if ($this->board[$yCoordinate][$xCoordinate] == 0) {
                $this->board[$yCoordinate][$xCoordinate] = $player;
                return;
            }
        }
    }

    function boardIsFull() {
        for ($xCoordinate = 0; $xCoordinate < 7; $xCoordinate++)
            if ($this->board[0][$xCoordinate] == 0) return false;

        return true;
    }

    function checkForWinningRow($player) {
        for ($i = 0; $i < 6; $i++) {     // Checks Horizontal groups
            for ($j = 0; $j < 4; $j++) {
                if ($this->board[$i][$j    ] == $player &&
                    $this->board[$i][$j + 1] == $player &&
                    $this->board[$i][$j + 2] == $player &&
                    $this->board[$i][$j + 3] == $player) return true;
            }
        }

        for ($i = 0; $i < 3; $i++) {     // Checks vertical groups
            for ($j = 0; $j < 7; $j++) {
                if ($this->board[$i    ][$j] == $player &&
                    $this->board[$i + 1][$j] == $player &&
                    $this->board[$i + 2][$j] == $player &&
                    $this->board[$i + 3][$j] == $player) return true;
            }
        }

        for ($i = 3; $i < 6; $i++) {     // Checks Ascending diagonal groups
            for ($j = 0; $j < 4; $j++) {
                if ($this->board[$i    ][$j    ] == $player &&
                    $this->board[$i - 1][$j + 1] == $player &&
                    $this->board[$i - 2][$j + 2] == $player &&
                    $this->board[$i - 3][$j + 3] == $player) return true;
            }
        }

        for ($i = 3; $i < 6; $i++) {     // Checks Descending Diagonal groups
            for ($j = 3; $j < 7; $j++) {
                if ($this->board[$i    ][$j    ] == $player &&
                    $this->board[$i - 1][$j - 1] == $player &&
                    $this->board[$i - 2][$j - 2] == $player &&
                    $this->board[$i - 3][$j - 3] == $player) return true;
            }
        }

        return false;
    }
}
