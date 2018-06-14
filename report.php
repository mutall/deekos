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

if(isset($decoded_json->name)){
    $name = trim($decoded_json->name);
}else{
    $name = null;
}
if(isset($decoded_json->period)){
    $period = trim($decoded_json->period);
}else{
    $period = null;
}
$display=trim($decoded_json->display);

$delivery = new Delivery();
?>
<html>
    <head>
        <title>title</title>
        <link rel="stylesheet" href="assets/css/style.css"/>
    </head>
    <body>
        <?php
        $delivery->show($name, $period, $display);

        ?>
    </body>
</html>
