<?php
date_default_timezone_set('Asia/Riyadh');
$currentDateTime = date("Y-m-d H:i");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snickers Play & Win </title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body class="homepage">
    <div class="outer-wraper">
        <?php // include_once('./en/inc/terms-en.php'); ?>
        <!-- popup ends-->
        
        <main class="main">

            <div class="header">
                <img src="assets/images/play-n-win.svg" alt="Play & Win" class="img-fluid">
            </div>
            <div class="bottom">
                <div class="score5">
                    <img src="assets/images/score-5-goals.svg" alt="Score 5 goals before time runs out" class="img-fluid">
                </div>
                <a href="ready.php" class="start-here btn"><img src="assets/images/start-here.svg" alt="Start Here"></a>
                <div class="alnassr">
                    <img src="assets/images/alnassar-football-club.svg" alt="Al Nassr Football Club" class="img-fluid">
                </div>
            </div>
            
            <div class="footer-left">
             <img src="assets/images/footer-bottom-left-shape.svg" alt="Snickers" class="img-fluid">
            </div>
        </main>

        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./assets/scripts/script.js"></script>
</body>
</html>