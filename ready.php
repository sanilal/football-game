<?php
$redirectUrl = "play.php";

// Specify the delay in seconds
$delay = 3;

echo "<!DOCTYPE html>
<html lang=\"ar\" dir=\"rtl\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta http-equiv=\"refresh\" content=\"$delay;url=$redirectUrl\">
    <title>Snickers - Play & Win</title>
    <link rel=\"stylesheet\" href=\"assets/css/style.css\">
</head>
<body class=\"home\" style=\"background-color: #f0e0d3;\">
    
    <div id=\"hero\"><img src=\"assets/images/ready-bg.png\" alt=\"Ready... Set... GO!\" class=\"img-fluid\" /></div>   

    <script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>
    <!-- <script src=\"assets/js/app.js\"></script> -->
</body>
</html>";
exit;
?>
