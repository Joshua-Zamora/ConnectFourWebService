<?php
define('PID', "pid");
define('MOVE', "move");
define('WRITE', dirname(dirname(__FILE__))."/writable/");

main();

function main() {
    $files = scandir(WRITE, 1);
    $acknowledgeMessage = array();

    if (!isset($_GET[PID])) {
        $acknowledgeMessage['response'] = false;
        $acknowledgeMessage['reason'] = "Pid not specified";
    }
    elseif (!isset($_GET[MOVE])) {
        $acknowledgeMessage['response'] = false;
        $acknowledgeMessage['reason'] = "Move not specified";
    }
    elseif (!array_search($_GET[PID], $files)) {
        $acknowledgeMessage['response'] = false;
        $acknowledgeMessage['reason'] = "Unknown pid";
    }
    elseif ($_GET[MOVE] < 0 || $_GET[MOVE] > 6) {
        $acknowledgeMessage['response'] = false;
        $acknowledgeMessage['reason'] = "Invalid slot, ' . MOVE . '";
    }

    if ($acknowledgeMessage['response'] == false) {
        echo json_encode($acknowledgeMessage);
        exit;
    }

    $board = new Board();

    $board->board = json_decode(WRITE . $_GET[PID] . 'txt');

    if (!$board->isValidCoordinate($_GET[MOVE])) {
        $acknowledgeMessage['response'] = false;
        $acknowledgeMessage['reason'] = "Column is full";
        echo json_encode($acknowledgeMessage);
        exit;
    }

    $board->insertDisc($_GET[MOVE], 1);

    $acknowledgeMessage['response'] = true;
    $acknowledgeMessage['ack_move'] = array();
    $acknowledgeMessage['ack_move']['slot'] = $_GET[MOVE];
    $acknowledgeMessage['ack_move']['isWin'] = false;
    $acknowledgeMessage['ack_move']['isDraw'] = false;
    $acknowledgeMessage['ack_move']['row'] = '[]';

    if ($board->checkForWinningRow(1)) {
        $acknowledgeMessage['ack_move']['isWin'] = true;

        echo json_encode($acknowledgeMessage);
        exit;
    }
    elseif ($board->boardIsFull()) {
        $acknowledgeMessage['ack_move']['isDraw'] = true;

        echo json_encode($acknowledgeMessage);
        exit;
    }

    $random = new Random();
    $smart = new Smart();

    if ($_GET[PID][0] == "R")
        $computedMove = $random->GetComputedCoordinates($board);
    else
        $computedMove = $smart->GetComputedCoordinates($board);

    $board->insertDisc($computedMove, 2);

    $acknowledgeMessage['move'] = array();
    $acknowledgeMessage['move']['slot'] = $computedMove;
    $acknowledgeMessage['move']['isWin'] = false;
    $acknowledgeMessage['move']['isDraw'] = false;
    $acknowledgeMessage['move']['row'] = '[]';

    if ($board->checkForWinningRow(2)) {
        $acknowledgeMessage['move']['isWin'] = true;

        echo json_encode($acknowledgeMessage);
        exit;
    }
    elseif ($board->boardIsFull()) {
        $acknowledgeMessage['move']['isDraw'] = false;

        echo json_encode($acknowledgeMessage);
        exit;
    }

    file_put_contents(WRITE . $_GET[PID] . 'txt', json_encode($board));

    echo json_encode($acknowledgeMessage);
}
