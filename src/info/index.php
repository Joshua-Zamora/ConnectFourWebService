<?php   // BY: JOSHUA ZAMORA AND AIRAM MARTINEZ

$strategies = array("Smart" => 0, "Random" => 1);
$info = array("width" => 7, "height" => 6, "strategies" => array_keys($strategies));
echo json_encode($info);
