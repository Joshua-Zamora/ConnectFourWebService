<?php   // BY: JOSHUA ZAMORA AND AIRAM MARTINEZ

require_once "Strategy.php";

class Random extends Strategy {
    function getXCoordinate($board) {

        do {
            $xCoordinate = rand(0, 6);
        } while ($board->board[0][$xCoordinate] != 0); // Continuously checks for an empty slot based on random number

        return $xCoordinate;
    }
}