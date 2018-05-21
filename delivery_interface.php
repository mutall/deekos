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
            <nav class="card-panel ">
                <div class="button-group branch">
                <?php
                $d->showClient();
            ?>
                    </div>
            </nav>
        </header>
        <aside class="card-panel all-Periods">
            <div class="button-group">
            <?php 
                $d->showPeriod();
                ?>
            </div>
        </aside>
        <div class=" card-panel" id="content">
            <button class='display button' id="raw">RAW TABLE</button>
            <button class='display button' id="net">NET VALUES</button>
            <button class='display button' id="variance">VARIANCES FOR THAT BRANCH</button>
        </div>
        <div class="card-panel">
            <p>You selected $foo branch</p>
            <p>For $bar period</p>
            <p>Display as $foo</p>
            <div class="button-group">
                <button id="continue" class="primary    button">CONTINUE</button>
                <button id="cancel" class="button" >CANCEL</button>
            </div>
        </div>
    </body>

    </html>
