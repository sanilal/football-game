<?php 
date_default_timezone_set('Asia/Riyadh');
$currentDate =  date("Y-m-d"); 
// $currentDate =  date("Y-m-d H:i"); 
$timestamp = time(); 
$date_time = date("d-m-Y (D) H:i:s", $timestamp); 
echo "Current date is: $currentDate". "<br>";
echo "Current Date & Time Of The Server Is: $date_time". "<br>"; 
echo "The time is " . date("h:i:sa"); 
?> 
