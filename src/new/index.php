<?php
define('WRITE', dirname(dirname(__FILE__))."/writable/");
define('STRATEGY', "strategy");

main();

function main() {
    $strategies = array("Smart"=> 0, "Random"=> 1); // supported strategies
    $strategy = $_GET[STRATEGY];
    $info = array();

    if (!array_key_exists(STRATEGY, $_GET) || $_GET[STRATEGY] == "") {
        $info['response'] = false;
        $info['reason'] = "Strategy not specified";
    } elseif (in_array(strtolower($strategy), array_map('strtolower', $strategies))) {
        $info['response'] = true;
        $info['pid'] = uniqid();
    } else {
        $info['response'] = false;
        $info['reason'] = "Strategy unknown";
    }
    echo json_encode($info);

    if ($info['response'] == true) {

        $board = new Board();

        if ($strategy == "Random" || $strategy == "random")
            file_put_contents(WRITE . 'R' . $info['pid'] . 'txt', json_encode($board->board));
        else
            file_put_contents(WRITE . 'S' . $info['pid'] . 'txt', json_encode($board->board));
    }
}
