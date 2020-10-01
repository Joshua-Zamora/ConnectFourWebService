<?php

require_once "Strategy.php";

class Random extends Strategy {
    function GetComputedCoordinates($board) {

        do {
            $xCoordinate = rand(0, 6);
        } while ($board->board[0][$xCoordinate] != 0);


        return $xCoordinate;
    }
}