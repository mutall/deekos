<?php
require_once 'deekos.php';

// check if the get global variable is set
//do a filter input
$get_super= filter_input(INPUT_GET, 'q');

if (!$get_super) {
    die('SUPER GLOBAL GET NOT SET');
}

$decoded_json = json_decode($get_super);
$name = $decoded_json->name;
$period = $decoded_json->period;

$delivery = new Delivery();

$delivery->show($name, $period);

