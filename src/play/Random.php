<?php

class Random extends Strategy {
    function __construct()
    {
        $this->strategy = "Random";
    }

    function GetComputedCoordinates() {

        do {
            $xCoordinate = rand(0, 6);
        } while(!isValidCoordinate($xCoordinate));

        return $xCoordinate;
    }
}