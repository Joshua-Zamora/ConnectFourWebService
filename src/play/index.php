<?php   // BY: JOSHUA ZAMORA AND AIRAM MARTINEZ

require_once "Board.php";
require_once "Random.php";
require_once "Smart.php";

error_reporting(E_ALL & ~E_NOTICE);     // Hides notices

define('PID', $_GET["pid"]);
define('MOVE', $_GET["move"]);
define('WRITE', dirname(dirname(__FILE__))."/writable/");

main();

function main() {
    $output = new out();

    if (PID == "")
        exit(json_encode(array("response" => false, "reason" => "Pid not specified")));   // Checks if pid is defined
    elseif (MOVE == "")
        exit(json_encode(array("response" => false, "reason" => "Move not specified")));  // Checks if move is defined
    elseif (MOVE < 0 || MOVE > 6)
        exit(json_encode(array("response" => false, "reason" => "Invalid slot, " . MOVE))); // Checks for valid move

    $fileContents = file_get_contents(WRITE . PID) or
    exit(json_encode(array("response" => false, "reason" => "Unknown pid")));;  // Retrieves pid file contents

    $board = new Board();
    $board->board = json_decode($fileContents)->board; // decodes 2d array to board object

    if ($board->board[0][MOVE] != 0)    // Checks if column is full
        exit(json_encode(array("response" => false, "reason" => "Invalid slot, " . MOVE)));

    $output->response = true;
    $output->ack_move = array("slot" => MOVE, "isWin" => false, "isDraw" => false,
        "row" => $board->winningRow(1));    // Creates player array

    $output->move = array("slot" => -1, "isWin" => false, "isDraw" => false,
        "row" => $board->winningRow(2));    // Creates AI array

    if (!empty($output->ack_move['row'])) {     // Checks if human has a winning row
        $output->ack_move['isWin'] = true;
        unlink(WRITE . PID);
    }
    elseif ($board->boardIsFull()) {    // Checks if the board is full
        $output->ack_move['isDraw'] = true;
        $output->move['isDraw'] = true;
        unlink(WRITE . PID);
    }
    elseif (!empty($output->move['row'])) {     // Checks if AI has a winning row
        $output->move['isWin'] = true;
        unlink(WRITE . PID);
    }
    else {
        $board->insertDisc(MOVE, 1);

        $output->ack_move['row'] = $board->winningRow(1);

        if (!empty($output->ack_move['row'])) {
            $output->ack_move['isWin'] = true;
            unlink(WRITE . PID);
        }
        else {
            $random = new Random();
            $smart = new Smart();

            if (json_decode($fileContents)->strategy == "Random")   // Picks strategy based on file
                $computedMove = $random->getXCoordinate($board);
            else
                $computedMove = $smart->getXCoordinate($board);

            $board->insertDisc($computedMove, 2);

            $output->ack_move['slot'] = MOVE;
            $output->move['slot'] = $computedMove;
            $output->move['row'] = $board->winningRow(2);

            if (!empty($output->move['row'])) {
                $output->move['isWin'] = true;
                unlink(WRITE . PID);
            }
            else {
                file_put_contents(WRITE . PID,
                    json_encode(array("strategy" => json_decode($fileContents)->strategy, "board" => $board->board)));
            }
        }
    }

    echo json_encode($output);
}

class out {
    /**
     * @var bool
     */
    public $response;
    /**
     * @var array
     */
    public $ack_move;
    /**
     * @var array
     */
    public $move;
}
