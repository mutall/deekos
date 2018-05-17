<?php
require_once 'crud.php';
require_once 'deekos.php';

$d = new Delivery();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Daily Deliveries</title>
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="deekos.js"></script>
        <script type="text/javascript" >
            var delivery= new Delivery();
        </script>
        </head>

    <body>
        <header id="header" class="col-12">
            <nav class="card-panel">
                <?php
                $d->showClient();
            ?>
            </nav>
        </header>
        <aside class="card-panel">
            <ul>
                <?php 
                    $d->showPeriod();
                    ?>
            </ul>
        </aside>
        <div class=" card-panel" id="content">
            <button class='display' id="raw">RAW TABLE</button>
            <button class='display' id="net">NET VALUES</button>
            <button class='display' id="variance">VARIANCES FOR THAT BRANCH</button>
            <button class='display' id="all">ALL IN ONE TABLE</button>

        </div>
        <div class="card-panel">
            <p>You selected $foo branch</p>
            <p>For $bar period</p>
            <p>Display as $foo</p>
            <button id="continue">CONTINUE</button>
            <button id="cancel">CANCEL</button>
        </div>
    </body>

    </html>
