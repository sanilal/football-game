<?php
session_start();

if (isset($_POST['goals'])) {
    $_SESSION['goals'] = intval($_POST['goals']); // Store the score in the session
    echo "Score saved: " . $_SESSION['goals']; // Optional for debugging
} else {
    echo "No score received.";
}
?>
