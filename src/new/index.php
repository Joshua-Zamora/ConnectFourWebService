<?php   // BY: JOSHUA ZAMORA AND AIRAM MARTINEZ

require dirname(dirname(__FILE__)) . "/play/Board.php";

error_reporting(E_ALL & ~E_NOTICE);     // Hides notices

define('WRITE', dirname(dirname(__FILE__))."/writable/");
define('STRATEGY', $_GET["strategy"]);

main();

function main() {
    $strategies = array("Smart"=> 0, "Random"=> 1); // supported strategies
    $info = array("response" => false);

    if (STRATEGY == "")
        $info['reason'] = "Strategy not specified";
    elseif (!array_key_exists(STRATEGY, $strategies))   // checks if given strategy exists
        $info['reason'] = "Strategy unknown";
    else {
        $info['response'] = true;
        $info['pid'] = uniqid();

        $board = new Board();

        file_put_contents(WRITE . $info['pid'],
            json_encode(array("strategy" => STRATEGY, "board" => $board->board)));
   }

    echo json_encode($info);
}
