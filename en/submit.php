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

$arabic=0;
$currentDate = date('Y-m-d');

if (isset($_REQUEST['btnadd'])) { 
    $spinnAllowed = true;
} else {
    $spinnAllowed = false;
}
// var_dump( $spinnAllowed); die;
// Delete
// $spinnAllowed = true;
// Delete

$spinId = '';


// Delete this
$spinnAllowed = true;



if(!$spinnAllowed) {
    header('Location: index.php');
}



 if(isset($_REQUEST['btnadd'])) {

   
    
    $ctime = time();
    function generateUniqueID($time)
        {
            // Use alphanumeric characters
            $spinId = 'spin_' . $time . bin2hex(random_bytes(4));

            return $spinId;
        }

    $spinId = generateUniqueID($ctime);

    // var_dump($spinId); die;

	$firstName=ucwords($_POST['first-name']);	
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $country='KSA';
    $city=$_POST['city'];
    $gender=$_POST['gender'];
    if($city === 'Others') {
        $city = $_POST['ocity-name'];
	}
    
    $mobsql="SELECT * FROM `md_shop_win` WHERE (`mobile` = '$mobile' OR `email` = '$email')";

    //     var_dump($mobsql); 
         $mobr1=mysqli_query($url,$mobsql) or die("Failed".mysqli_error($url));
           $mobrowcount=mysqli_num_rows($mobr1);
           if($mobrowcount != 0) {
             $participation=1;
          //   echo $participation; die;
           } else {
            $participation=0;
           }



	$series=0;  
    $randomNumber = rand(1,10000);
  //  var_dump($randomNumber); die;
    if($firstName!="" && $email !="" && $mobile !="" ){
        //if($firstName!="" && $invoiceNumber!="" && $email !=""){
            
              //  var_dump($randomNumber); die;
            
           

	   // 	var_dump($_FILES['inputInvoice']); die;
		// var_dump($p_image); exit;
		//
		$msg=""; $error="";
		  //var_dump($num); exit;
		// $sql="select * from `".TB_pre."shop_win` WHERE `mobile` = '$mobile'  ";
		// $r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));
		//   $rowcount=mysqli_num_rows($r1);
		//$res = mysqli_fetch_array($r1);	
        
        $currentDate = date('Y-m-d');
		// if($rowcount == 0) {
            $query = "INSERT INTO `".TB_pre."shop_win` (`spin_id`,`first_name`,`country`,mobile,`email`,`gender`,`emirate`,`zone_country`,`participated`,`is_arabic`,`sessionid`) VALUES('$spinId','$firstName','$country','$mobile','$email','$gender','$city', 'ksa', '$participation', '$arabic', '$ctime')";
		  $r = mysqli_query($url, $query) or die(mysqli_error($url));


          $_SESSION['spinId'] = $spinId;
          $_SESSION['sessionId'] = $ctime;
		  if($r){
			  $active = "active";

              $sql="select * from `".TB_pre."shop_win` WHERE `mobile` = '$mobile' && `email` = '$email'  && `sessionid` = '$ctime' ";
           //   var_dump($sql); die;
               $r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));
                 $rowcount=mysqli_num_rows($r1);
               $res = mysqli_fetch_array($r1);	
       
               $spinId = $res['spin_id'];
               $winner = $res['entry_id'];
             //  var_dump($spinId); die;

                     $_SESSION['form_submitted'] = true;
                        
                      }
                      else {
                          $active = "no-active";
                          $error.= "Failed: Error occured";
                      }
                  } else {
                        header('Location: index.php');
                    }

                    $verifySql="select * from `".TB_pre."shop_win` WHERE `entry_id` = $winner";
                    $verifyR1=mysqli_query($url,$verifySql) or die("Failed".mysqli_error($url));
                    $verifyRowcount=mysqli_num_rows($verifyR1);
                    $verifyRes = mysqli_fetch_array($verifyR1);	
                    $entryName = $verifyRes['first_name'];
                    $entryId = $verifyRes['spin_id'];
            
                } else {
                    $notvalid = true;
                      //     echo '<script> 
                //     alert("This code number is either incorrect or already used.");
                //     setTimeout(function() {
                //         window.location.href = "/";
                //     }, 1000); // Delay for 10 seconds (10000 milliseconds)
                // </script>';
                // exit();

                }
                //  code check end

//  var_dump($entryId);
               
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snickers Play & Win</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="form-page innerpages">
    <div class="outer-wraper">
    <?php include_once('./inc/terms-en.php'); ?>
        <!-- popup ends-->

        <div class="main-container" id="spin-page">
        
      <?php if(isset($entryId)) { ?>

        <main class="main">
            <div class="header">
                <img src="../assets/images/form-header.webp" alt="Win with Pert plus" class="img-fluid fadeinimages lefttorightfade">
                <div class="winwithtxt">
                <img src="../assets/images/win-with-pert.svg" alt="Win with Pert plus" class="img-fluid inout">
                </div>
            </div>
                <div class="win-cash fadeinimages">
                    <h2 class="text-white">Thank you for your paticipation. You
                    will be notified if you are a winner</h2>
                  
                </div>
                <section class="campaign fadeinimages">
                <div class="participation <?php if(isset($active)) {  echo $active; } else { echo 'no-active';} ?>">
                    <div class="red-box">
            
                    <?php if(isset($msg)){ if($msg!=""){ 
                    echo $msg;
                }}?>
                <?php if(isset($error)){ if($error!=""){ ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> <?php echo $error; ?></h4>
                        
                    </div>
                <?php } } ?>
                    </div>
                </div>
                <div class="submit-receiptbtn">
                    <a href="submit-invoice.php?eid=<?php echo $entryId?>" class="clickhere">Click here</a>
                    <p class="text-white text-shadow">If you have purchased
                    any Pert product</p>
                    <p class="text-white text-shadow">Get a chance to win an iphone 16
                    and many more prizes</p>

                    <img src="../assets/images/gift.png" alt="Get a chance to win an iphone 16
and many more prizes" class="img-fluid">
            
                </div>
            </div>
            </section>
                
            </main>

     <?php  }  else { header("Location: index.php"); }?>

     
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="../assets/scripts/script.js"></script> -->
</body>
</html>