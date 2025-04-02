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
<body class="innerpages">
    <div class="outer-wraper">
        <?php // include_once('./en/inc/terms-en.php'); ?>
        <!-- popup ends-->
        
        <main class="main">

            <div id="football_game">
            <div class="header">
                <div class="headerlogos">
                    <img src="assets/images/snickers-logo.svg" alt="Snickers" class="img-fluid snickers-logo">
                    <img src="assets/images/alnassar-football-club.svg" alt="Al Nassr Football Club" class="img-fluid alnassr-logo">
                </div>
                <div id="scoreboard" class="digital7">
                    <div class="time"><span class="small">Time</span><span> 00:</span><span id="timer">20</span></span></div>
                    
                    <div class="goals">
                        <div class="goals-col">
                            <span class="hunfan"> HUNGER</span><span class="scorepoint">00</span>
                        </div>
                        <div class="goals-col">
                            <span class="hunfan"> FAN</span><span id="goal-count" class="scorepoint">05</span>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <div id="game-container">
                
                <div id="goalpost"><img src="assets/images/goal-post.png" alt="Goal Post" class="img-fluid"></div>
                <img id="football" src="assets/images/football.png" alt="Football" class="img-fluid">
                <div id="message-overlay" class="hidden"></div>
            </div>
            </div>
           
        </main>

        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./assets/scripts/game.js"></script>
</body>
</html>