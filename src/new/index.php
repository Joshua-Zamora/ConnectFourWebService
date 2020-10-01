<?php
require dirname(dirname(__FILE__)) . "/play/Board.php";

define('WRITE', dirname(dirname(__FILE__))."/writable/");
define('STRATEGY', "strategy");

main();

function main() {
    $strategies = array("Smart"=> 0, "Random"=> 1, "smart" => 2, "random" => 3); // supported strategies
    $info = array();

    if (!isset($_GET[STRATEGY])) {
        $info['response'] = false;
        $info['reason'] = "Strategy not specified";
    }
    elseif (!array_key_exists($_GET[STRATEGY], $strategies)) {
        $info['response'] = false;
        $info['reason'] = "Strategy unknown";
    }
    else {
       $info['response'] = true;
       $board = new Board();

       if ($_GET[STRATEGY] == "Random" || $_GET[STRATEGY] == "random") {
           $info['pid'] = 'R' . uniqid();
           file_put_contents(WRITE . $info['pid'], json_encode($board->board));
       }
       else {
           $info['pid'] = 'S' . uniqid();
           file_put_contents(WRITE . $info['pid'], json_encode($board->board));
       }
   }

    echo json_encode($info);
}
