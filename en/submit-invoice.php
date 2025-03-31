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

$entryId=$_GET['eid'];
// var_dump($spinId); die;

$formSubmitted = isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true;
// var_dump($_SESSION['form_submitted']); die;


$_SESSION['form_submitted'] = false; // Reset the session variable

include("../snickersAdmin987/includes/conn.php"); 

$arabic=0;
$currentDate = date('Y-m-d');

// if(isset($_POST['sessionNumber'])) {
//     echo $_POST['sessionNumber']; die;
// } 


$spinSql = "SELECT * FROM `" . TB_pre . "shop_win` WHERE `spin_id` = '$entryId' AND (`invoice_no` = '' OR `invoice_no` IS NULL)";

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




// var_dump( $spinnAllowed); die;
// Delete
// $spinnAllowed = true;
// Delete

$spinId = '';





// if(!$spinnAllowed) {
   
//     header('Location: index.php');
// }
// var_dump($spinnAllowed); die;


if (isset($_REQUEST['invadd'])) {
   
    $country = 'KSA';
	
    $invNumber=$_POST['inv-number'];
    
    $invoiceSql="select * from `".TB_pre."shop_win` WHERE `invoice_no` = '$invNumber'";
    $invoicer1=mysqli_query($url,$invoiceSql) or die("Failed".mysqli_error($url));
    $invoicerowcount=mysqli_num_rows($invoicer1);
    if ($invoicerowcount != 0) { 
        echo '<script> 
        alert("This invoice number has been previously submitted");
        setTimeout(function() {
            window.location.href = "/";
            }, 1000); // Delay for 10 seconds (10000 milliseconds)
            </script>';
            exit(); // Stop script execution
        }
        $sessionId=$_POST['sessionId'];
        
        if($sessionId !="" && $invNumber !=""){
            include_once("../snickersAdmin987/classes/class.upload.php");
            $p_image=image_upload($_FILES['inputInvoice'],$invoiceNumber."main_img".time());
            
            $g_image="";
            for($i=1;$i<=12;$i++){
                $u_image=image_upload($_FILES['productimg'.$i],$product."g_img".$i);
                //var_dump($_FILES['productimg'.$i]);
                if($u_image!=""){
                    $g_image.=",".$u_image;
                }
            }
            $g_image=ltrim($g_image,",");
       
            $msg=""; $error="";        
        $sql="select * from `".TB_pre."shop_win` WHERE  `spin_id` = '$sessionId' ";
        // var_dump($sql); die;
        $r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));
        $rowcount=mysqli_num_rows($r1);
        $res = mysqli_fetch_array($r1);	

      $winner = $res['entry_id'];
    $fullName = $res['first_name'];

            
      if($rowcount == 1) {
         // var_dump($sql); die;
         $query = "UPDATE `" . TB_pre . "shop_win` 
         SET `invoice_no` = '$invNumber', `invoice_img` = '$p_image' 
         WHERE `spin_id` = '$sessionId'";


        $r = mysqli_query($url, $query) or die(mysqli_error($url));
        if($r){

          $_SESSION['form_submitted'] = true;

        }
        else {
            $active = "no-active";
            $error.= "Failed: Error occured";
        }
    } else {
          header('Location: index.php');
      }
      
  }
    
    $ctime = time();
    function generateUniqueID($time)
        {
            // Use alphanumeric characters
            $spinId = 'spin_' . $time . bin2hex(random_bytes(4));

            return $spinId;
        }

    $spinId = generateUniqueID($ctime);

    // var_dump($spinId); die;


    




	$series=0;  
    $randomNumber = rand(1,10000);
 

                    //echo 658; die;

                    $verifySql = "SELECT * FROM `" . TB_pre . "shop_win` WHERE `entry_id` = '$winner' AND `invoice_no` = '$invNumber'";

                    $verifyR1=mysqli_query($url,$verifySql) or die("Failed".mysqli_error($url));
                    $verifyRowcount=mysqli_num_rows($verifyR1);
                    $verifyRes = mysqli_fetch_array($verifyR1);	
                    $entryName = $verifyRes['first_name'];
                    $invoiceNo = $verifyRes['invoice_no'];
                    $newSpinId = $verifyRes['spin_id'];
// var_dump($verifyRowcount); die;
                    if($verifyRowcount>0) {
                        header('Location: success.php?res=' . $newSpinId);
                        exit();
                        
                    } else {
                        $errorMessage = "Something went wrong, Please try again";

                    }
            // var_dump($successMessage); die;
                } else {
                  //  echo 146; die;
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

 // var_dump($entryName);
               
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snickers Play & Win</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="form-page finalpage">
    <div class="outer-wraper">
    <?php include_once('./inc/terms-en.php'); ?>
        <!-- popup ends-->

        <div class="main-container" id="spin-page">
        
        <main class="main">
            <div class="header">
                <img src="../assets/images/invoice-header.webp" alt="Win with Pert plus" class="img-fluid fadeinimages lefttorightfade">
                <div class="winwithtxt dark">
                <img src="../assets/images/win-with-pert-men.svg" alt="Win with Pert plus" class="img-fluid inout">
                </div>
            </div>
                <div class="win-cash fadeinimages">
                    <h2 class="text-white">To win iphone 16 and other exciting prizes
                    enter the invoice number and upload receipt</h2>
                  
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
                <form role="form" method="post"  class="form-horizontal" action="submit-invoice.php?eid=<?php echo $entryId; ?>" enctype="multipart/form-data" id="getCoupon" >
                    <input type="hidden" name="sessionId" value="<?php echo $entryId ?>">
                <input type="text" class="form-control" placeholder="Invoice number*" name="inv-number" id="inv-number" required />
						<div id="inv-number-err"></div>
                        <div id="invoice_exists"></div>
                        <div class="invoice-upload">
                <div class="invoice-wraper" >
                    <span class="invoice-copy">Upload your purchase reciept</span>
                    <span class="file-select">Upload</span>
                 </div>
                <!-- <p style="padding-left:15px;">Kindly upload a clear invoice copy</p> -->
                <input type="file" name="inputInvoice" class="form-control inputInvoice hideNow" accept="image/*" id="inputInvoice" placeholder="Upload picture" required >
                
                <div id="invoice-err"></div>
            </div>
            <div class="form-buttons"><input type="submit" value="Submit" class="btn actionBtn submitnreset" name="invadd" id="submit-receipt" />
            </div>

                </form>

                    <img src="../assets/images/gift.png" alt="Get a chance to win an iphone 16
and many more prizes" class="img-fluid ">
            
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
    <script src="../assets/scripts/script.js"></script>
</body>
</html>