<?php
require_once 'deekos.php';

// check if the get global variable is set
//do a filter input
$get_super= filter_input(INPUT_GET, 'q');

if (!$get_super) {
    die('SUPER GLOBAL GET NOT SET');
}
//decode the json string obtained
$decoded_json = json_decode($get_super);
$name = $decoded_json->name;
$period = $decoded_json->period;

$delivery = new Delivery();

//do a switch statement to display data in a when the user selects a display type
$display=$decoded_json->display;

switch($display){
    case 'raw':
        $delivery->show($name, $period);
        break;
    case 'net':
        $delivery->showNet($name, $period);
        break;
    case 'variance':
        $delivery->showVariance($name, $period);
        break;
    case 'all':
        $delivery->showAll($name, $period);
        break;
}





