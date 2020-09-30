<?php

class Random extends Strategy {
    function GetComputedCoordinates($board) {

        do {
            $xCoordinate = rand(0, 6);
        } while(!$board->isValidCoordinate($xCoordinate));

        return $xCoordinate;
    }
}