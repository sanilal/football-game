<?php
date_default_timezone_set('Asia/Riyadh');
// $currentDate =  date("Y-m-d"); 
// // $currentDate =  date("Y-m-d H:i"); 
// $timestamp = time(); 
// $date_time = date("d-m-Y (D) H:i:s", $timestamp); 
// echo "Current date is: $currentDate". "<br>";
// echo "Current Date & Time Of The Server Is: $date_time". "<br>"; 
// echo "The time is " . date("h:i:sa"); 
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
        <?php include_once('./en/inc/terms-en.php'); ?>
        <!-- popup ends-->
        
        <main class="main">
            <div class="header">
            <img src="assets/images/home-main-bg.png" alt="Pert Scan & Win" class="img-fluid">
            <img src="assets/images/scan-win.png" alt="Scan & Win" class="scan-win">

            <div class="actions">
           <div class="select-lang text-black d-flex flex-column" >
           <span class="arabic text-medium text-center text-white ">
           *لقد انتهت الحملة الآن!*   

شكرًا لكم جميعًا على مشاركتكم.  

 *سيتم التواصل مع الفائزين عبر البريد الإلكتروني قريبًا.*  

لديكم أي أسئلة؟ لا تترددوا في مراسلتنا عبر البريد الإلكتروني: 
                </span>
                <span class="text-medium text-center text-white ">
                notification@winwithpert.com
                </span>
                <br>
                <span class="text-medium text-center text-white ">
                The campaign has now ended! <br>

Thank you all for your participation.<br>

Winners will be contacted via email shortly.<br>

Have any questions? Feel free to email us at <br>notification@winwithpert.com
                </span>
                
               
                <div class="termsspl">
                    <p class="termsClick text-white">Terms & Conditions </p>
                </div>
            </div>
           </div>
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