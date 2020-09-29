<?php

class Random extends Strategy {
    function __construct()
    {
        $this->strategy = "Random";
    }

    function GetComputedCoordinates($board) {

        do {
            $xCoordinate = rand(0, 6);
        } while(!$board->isValidCoordinate($xCoordinate));

        return $xCoordinate;
    }
}