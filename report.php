<?php
require_once 'bootstrap.php';

// check if the get global variable is set
//do a filter input
$get_super= filter_input(INPUT_GET, 'q');

if (!$get_super) {
    die('SUPER GLOBAL GET NOT SET');
}
//decode the json string obtained
$decoded_json = json_decode($get_super);
$name = (!is_null($decoded_json->name))?$decoded_json->name:null;
$period = (!is_null($decoded_json->period))?$decoded_json->period:null;
$display=$decoded_json->display;

$delivery = new Delivery();

?>
<html>
    <head>
        <title>title</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php
        $delivery->show($name, $period, $display);

        ?>
    </body>
</html>