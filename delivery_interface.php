<?php
require_once 'crud.php';
require_once 'deekos.php';

$d = new Delivery()
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Daily Deliveries</title>
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="deekos.js"></script>
        <script type="text/javascript">
            var d = new Delivery();
        </script>
    </head>
    <body>
        <header id="header" class="col-13">
            <nav>
                <?php
                $d->showClient();
                ?>
            </nav>
        </header>
        <div class="container">
            <aside>
                <ul>
                    <?php 
                    $d->showPeriod();
                    ?>
                </ul>
            </aside>
            <content class="col-12" id="content">


            </content>
        </div>
    </body>
</html>