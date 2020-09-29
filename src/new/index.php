<?php // index.php
define('STRATEGY', 'strategy'); // constant
$strategies = array("Smart"=> 0, "Random"=> 1); // supported strategies

if (!array_key_exists(htmlspecialchars($_GET["strategy"]), $strategies)) {
    echo '{"response": false, "reason": "Strategy not specified"}';
    exit;
}

$strategy = $_GET[STRATEGY];
// write your code here … use uniqid() to create a unique play id.

