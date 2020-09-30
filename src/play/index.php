<?php
define('PID', htmlspecialchars($_GET["pid"]));
define('MOVE', htmlspecialchars($_GET["move"]));
define('WRITE', dirname(dirname(__FILE__))."/writable/");

main();

function main() {
    $files = scandir(WRITE, 1);
    checkPid($files);

    $board = new Board();

    $board->board = json_decode(PID . 'txt');


    if (!$board->isValidCoordinate(MOVE)) {
        echo '{"response": false, "reason": "Column is full"}';
        exit;
    }

    $board->insertDisc(MOVE, 1);

    if ($board->checkForWinningRow(1)) {
        echo '{"response": true,
               "ack_move": {
               "slot": '. MOVE .', 
               "isWin": true,
               "isDraw": false,
               "row": []}';
        exit;
    }
    elseif ($board->boardIsFull()) {
        echo '{"response": true,
               "ack_move": {
               "slot": '. MOVE .', 
               "isWin": false,
               "isDraw": true,
               "row": []}';
        exit;
    }

    $random = new Random();
    $smart = new Smart();

    if (PID[0] == "R")
        $computedMove = $random->GetComputedCoordinates($board);
    else
        $computedMove = $smart->GetComputedCoordinates($board);

    $board->insertDisc($computedMove, 2);

    if ($board->checkForWinningRow(2)) {
        echo '{"response": true,
               "ack_move": {
               "slot": '. MOVE .', 
               "isWin": false,
               "isDraw": false,
               "row": []}
               "move": {
               "slot": '. $computedMove . ', 
               "isWin": true, 
               "isDraw": false, 
               "row": []}}';
        exit;
    }
    elseif ($board->boardIsFull()) {
        echo '{"response": true,
               "ack_move": {
               "slot": '. MOVE .', 
               "isWin": false,
               "isDraw": false,
               "row": []}
               "move": {
               "slot": '. $computedMove . ', 
               "isWin": false, 
               "isDraw": true, 
               "row": []}}';
        exit;
    }

    file_put_contents(PID . 'txt', json_encode($board));

}

function checkPid($files) {
    if (PID == "") {
        echo '{"response": false, "reason": "Pid not specified"}';
        exit;
    }
    elseif (MOVE == "") {
        echo '{"response": false, "reason": "Move not specified"}';
        exit;
    }
    elseif (!array_search(PID, $files)) {
        echo '{"response": false, "reason": "Unknown pid"}';
        exit;
    }
    elseif (MOVE < 0 || MOVE > 6) {
        echo '{"response": false, "reason": "Invalid slot, ' . MOVE . '"}';
        exit;
    }
}

