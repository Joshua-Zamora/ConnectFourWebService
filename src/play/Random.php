<?php

require_once "Strategy.php";

class Random extends Strategy {
    function GetComputedCoordinates($board) {

        for ($xCoordinate = 0; $xCoordinate < 7; $xCoordinate++) {
            if ($board->board[0][$xCoordinate] == 0) return $xCoordinate;
        }

        return 0;
    }
}