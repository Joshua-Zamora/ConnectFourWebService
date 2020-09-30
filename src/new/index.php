<?php
require dirname(dirname(__FILE__)) . "/play/Board.php";

define('WRITE', dirname(dirname(__FILE__))."/writable/");
define('STRATEGY', $_GET["strategy"]);

main();

function main() {
    $strategies = array("Smart"=> 0, "Random"=> 1, "smart" => 2, "random" => 3); // supported strategies
    $info = array();

    if (!array_key_exists(STRATEGY, $strategies)) {
        $info['response'] = false;
        $info['reason'] = "Strategy unknown";
    }
    elseif (STRATEGY == "") {
        $info['response'] = false;
        $info['reason'] = "Strategy not specified";
    }
   else {
       $info['response'] = true;
       $board = new Board();

       if (STRATEGY == "Random" || STRATEGY == "random") {
           $info['pid'] = 'R' . uniqid();
           file_put_contents(WRITE . $info['pid'] . 'txt', json_encode($board->board));
       }
       else {
           $info['pid'] = 'S' . uniqid();
           file_put_contents(WRITE . $info['pid'] . 'txt', json_encode($board->board));
       }
   }

    echo json_encode($info);
}
