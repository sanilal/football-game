<?php  
ob_start();
date_default_timezone_set('Asia/Riyadh');
// $currentDate =  date("Y-m-d"); 
// // $currentDate =  date("Y-m-d H:i"); 
// $timestamp = time(); 
// $date_time = date("d-m-Y (D) H:i:s", $timestamp); 
// echo "Current date is: $currentDate". "<br>";
// echo "Current Date & Time Of The Server Is: $date_time". "<br>"; 
// echo "The time is " . date("h:i:sa"); 

// Check if the form was previously submitted
session_start();
$formSubmitted = isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true;
// var_dump($_SESSION['form_submitted']); die;


$_SESSION['form_submitted'] = false; // Reset the session variable

include("../snickersAdmin987/includes/conn.php"); 

$entryId=$_GET['res'];



$spinSql = "SELECT * FROM `" . TB_pre . "shop_win` WHERE `spin_id` = '$entryId' AND `invoice_no` IS NOT NULL AND `invoice_no` != ''";


//   var_dump($spinSql); die;
    $spinR1=mysqli_query($url,$spinSql) or die("Failed".mysqli_error($url));
      $spinRowcount=mysqli_num_rows($spinR1);
    $spinRes = mysqli_fetch_array($spinR1);	

    
    $currentUser = $spinRes['entry_id'];

   // var_dump($currentUser); die;

if(!isset($currentUser)) {
    header("Location: index.php"); 
} else {
    $spinnAllowed = true;
  //  echo(333); die;
}
?>



<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snickers Play & Win</title>
    <link rel="stylesheet" href="../assets/css/style-rtl.css">
</head>
<body class="form-page finalpage">
    <div class="outer-wraper">
    <?php include_once('./inc/terms-ar.php'); ?>
        <!-- popup ends-->

        <div class="main-container" id="spin-page">
        
        <main class="main">
            <div class="header">
                <img src="../assets/images/success-header.webp" alt="Win with Pert plus" class="img-fluid fadeinimages lefttorightfade">
                <div class="winwithtxt dark">
                <img src="../assets/images/win-with-pert-plus-ar.svg" alt="Win with Pert plus" class="img-fluid inout">
                </div>
            </div>
                
                <section class="campaign fadeinimages">
          
                <div class="submit-receiptbtn">
               <?php 
               if(isset($currentUser)) { ?>

               <div class="succMsg">
                <h3>تم استلام تسجيلك،
سيتم ابلاغك
إذا كنت فائزً</h3>
<span class="extraShape"></span>
               </div>

<div class="drawdate">
    <p class="text-white">تاريخ السحب : 25 فبراير 2025</p>
</div>
<?php } ?>

                    <img src="../assets/images/gift.png" alt="Get a chance to win an iphone 16
and many more prizes" class="img-fluid">
            
                </div>
                <div class="termsspl">
                        <p class="termsClick text-white lowercase">الأحكام و الشروط </p>
                    </div>
            </div>
            </section>
                
            </main>

     
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../assets/scripts/script-ar.js"></script>
</body>
</html>