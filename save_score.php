<?php
session_start();
//var_dump($_POST['goals']);  die;// Debugging line to check the incoming data
if (isset($_POST['goals'])) {
    $_SESSION['goals'] = intval($_POST['goals']); // Store the score in the session
    echo "Score saved: " . $_SESSION['goals']; die; // Optional for debugging
} else {
    $_SESSION['goals'] = 0; // Default value if no score is received
    echo "No score received.";
}
?>
