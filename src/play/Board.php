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

    function isValidCoordinate($xCoordinate) {
        if ($xCoordinate < 0 || $this->board[0][$xCoordinate] != 0) return false;
        else return true;
    }

    function insertDisc($xCoordinate, $player) {
        for ($yCoordinate = 5; $yCoordinate > -1; $yCoordinate--) {
            if ($this->board[$yCoordinate][$xCoordinate] == 0)
                $this->board[$yCoordinate][$xCoordinate] = $player;
        }
    }

    function boardIsFull() {
        foreach ($this->board[0] as $slot)
            if ($slot == 0) return false;

        return true;
    }


}