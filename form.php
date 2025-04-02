<?php 
ob_start();
session_start();

date_default_timezone_set('Asia/Riyadh');


// Define Encryption Key and IV (Store these securely)
define('ENCRYPTION_KEY', 'jZHK0OFSek6daFrykfT2wKwS4VaFXeOl+dT1Lqqj8KI=');
define('ENCRYPTION_IV', '8VDLsosIr0ehVqMRAjyLaw==');

// Encryption Function
function customEncrypt($data) {
    $key = ENCRYPTION_KEY;
    $iv = substr(hash('sha256', ENCRYPTION_IV), 0, 16);
    return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv));
}

// Decryption Function
function customDecrypt($encryptedData) {
    $key = ENCRYPTION_KEY;
    $iv = substr(hash('sha256', ENCRYPTION_IV), 0, 16);
    return openssl_decrypt(base64_decode($encryptedData), 'AES-256-CBC', $key, 0, $iv);
}

if (!isset($_SESSION['goals']) || $_SESSION['goals'] < 1) {
    if (isset($_POST['goal']) && !empty($_POST['goal'])) {
        $decryptedGoal = customDecrypt($_POST['goal']); // Decrypt goal from POST
        if ($decryptedGoal !== false && is_numeric($decryptedGoal)) {
            $_SESSION['goals'] = (int) $decryptedGoal; // Store back to session
        }
    } else {
        // Redirect to play.php if no valid goal is found
        header("Location: play.php");
        exit();
    }
}



$encryptedGoal = customEncrypt($_SESSION['goals']);

// $goals = $_SESSION['goals'];  // Retrieve the score from session

$formSubmitted = isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true;


$_SESSION['form_submitted'] = false; // Reset the session variable
// var_dump($_SESSION['form_submitted']); die;


// $currentDate =  date("Y-m-d"); 
// // $currentDate =  date("Y-m-d H:i"); 
// $timestamp = time(); 
// $date_time = date("d-m-Y (D) H:i:s", $timestamp); 
// echo "Current date is: $currentDate". "<br>";
// echo "Current Date & Time Of The Server Is: $date_time". "<br>"; 
// echo "The time is " . date("h:i:sa"); 

include("snickersAdmin987/includes/conn.php"); 

$arabic=0;





$prevspiId = isset($_GET['spinid']) ? $_GET['spinid'] : '';
if ($prevspiId) {
    $prevEntrySql = "select * from `".TB_pre."shop_win` WHERE `spin_id` = '$prevspiId' ";
    //  var_dump($prevEntrySql); die;
    $prevEntryR1=mysqli_query($url,$prevEntrySql) or die("Failed".mysqli_error($url));
    $prevEntryRes = mysqli_fetch_array($prevEntryR1);	
    //var_dump($prevEntryRes); exit;
    
    $firstName=$prevEntryRes['first_name'];	
    $mobile=$prevEntryRes['mobile'];
    $email=$prevEntryRes['email'];
    $country='KSA';
    $city=$prevEntryRes['emirate'];
    
	$series=0;  
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

	$firstName=ucwords($_POST['name']);	
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $country='KSA';
    $city=$_POST['city'];
    if($city === 'Others') {
        $city = $_POST['ocity-name'];
	}
    
    $mobsql="SELECT * FROM `md_shop_win` WHERE (`mobile` = '$mobile' OR `email` = '$email')";

        // var_dump($mobsql); die;
         $mobr1=mysqli_query($url,$mobsql) or die("Failed".mysqli_error($url));
           $mobrowcount=mysqli_num_rows($mobr1);
           if($mobrowcount != 0) {
             $participation=1;
             header("Location: participated.php");
             exit();
          //   echo $participation; die;
           } else {
            $participation=0;
           }


	$series=0;  
    $randomNumber = rand(1,10000);
  //  var_dump($randomNumber); die;
    if($firstName!="" && $email !="" && $mobile !="" ){
   
		//
		$msg=""; $error="";

        $currentDate = date('Y-m-d');
		// if($rowcount == 0) {
            if(isset($decryptedGoal)) {
            $query = "INSERT INTO `".TB_pre."shop_win` (`spin_id`,`first_name`,`country`,mobile,`email`,`emirate`,`goal`,`zone_country`,`participated`,`is_arabic`,`sessionid`) VALUES('$spinId','$firstName','$country','$mobile','$email','$city','$decryptedGoal', 'ksa', '$participation', '$arabic', '$ctime')";
		  $r = mysqli_query($url, $query) or die(mysqli_error($url));
            }
            else {
                    header("Location: play.php");
                    exit();
                 }

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
                     header("Location: thanks.php");
                        
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="formpage">
    <div class="outer-wraper">
        <?php include_once('terms-en.php'); ?>
        <!-- popup ends-->
        <div class="main-container">
            
            <main class="main">
                <div class="form-header">
                    <img src="assets/images/header-top-right-shape.png" alt="Snickers Play & Win" class="img-fluid header-top-right-shape">
                </div>
                <div class="form-container">
            
                <div class="win-cash fadeinimages <?php if($participation==1) {echo 'hideNow';}  ?>">
                <h1>يرجى ملء البيانات الشخصية  </h1>
            <h1 class="english avenir-bold">Please fill your details  </h1>
       
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
                <div class="container">
            <div class="shop-form">
                <?php 
                    $alertMessage = isset($_GET['alertMessage']) ? $_GET['alertMessage'] : '';
                    if ($alertMessage) {
                        echo '<div class="alert-message">' . htmlspecialchars($alertMessage) . '</div>';
                    }
                ?>
                
                
                <div id="submit-form">
           
        <?php $prevspiId = isset($_GET['spinid']) ? $_GET['spinid'] : ''; ?>
        <form role="form" method="POST"  class="form-horizontal " action="form.php" enctype="multipart/form-data" id="image-form" >
           
                        <div class="form-group">
                            <label for="name"><span class="english avenir">Name</span><span class="arabic">الاسم  </span></label>
                            <input type="hidden" name="goal" value="<?= htmlspecialchars($encryptedGoal, ENT_QUOTES, 'UTF-8') ?>">

                            <input type="<?php echo $prevspiId ? 'hidden' : 'text'; ?>" class="form-control" name="name" id="name" required <?php if ($prevspiId) {echo 'value="' . $name . '"';} ?> placeholder="Complete Name" />
                            <div id="name-err"></div>
                        </div>
                        <div class="form-group">
                            <label for="mobile"><span class="english avenir">Mobile</span><span class="arabic">رقم الهاتف </span></label>
                            <input type="<?php echo $prevspiId ? 'hidden' : 'tel'; ?>" name="mobile" class="form-control inputmobile" id="inputNumber" required <?php if ($prevspiId) {echo 'value="' . $mobile . '"';} ?> placeholder="000 0000 000" >
                            <div id="mobile-err"></div>
                        </div>
                        <div class="form-group">
                            <label for="email"><span class="english avenir">Email</span><span class="arabic">البريد الإلكتروني  </span></label>
                            <input type="<?php echo $prevspiId ? 'hidden' : 'email'; ?>" class="form-control" name="email" id="inputEmail4" required <?php if ($prevspiId) {echo 'value="' . $email . '"';} ?> placeholder="name@gmail.com"/>
                            <div id="email-err"></div>
                        </div>
                        <div class="form-group">
                            <label for="city"><span class="english avenir">City/Country</span><span class="arabic">المدينة / البلد  </span></label>
                            <!-- <input type="<?php // echo $prevspiId ? 'hidden' : 'text'; ?>" class="form-control" name="city" id="city" required <?php // if ($prevspiId) {echo 'value="' . $city . '"';} ?> placeholder="City/Country" /> -->

                            <div class="form-select-box">
              <select class="form-select form-control" name="city" id="city" required>
                  <option value="" selected>Select your city</option>
                  <option value="east-ksa">East KSA</option>
    <option value="west-ksa">West KSA</option>
    <option value="north-ksa">North KSA</option>
    <option value="central-ksa">Central KSA</option>
                  <!-- <option value="S101 - Tamimi Corniche, Khobar">S101 - Tamimi Corniche, Khobar</option>
                  <option value="S103 - Tamimi Aqrabya, Khobar">S103 - Tamimi Aqrabya, Khobar</option>
                  <option value="S106 - Tamimi Rakka, King Fahad Rd, Khobar">S106 - Tamimi Rakka, King Fahad Rd, Khobar</option>
                  <option value="S115 - Tamimi Aziziyah, Dammam">S115 - Tamimi Aziziyah, Dammam</option>
                  <option value="S116 - Tamimi Doha, Dahran">S116 - Tamimi Doha, Dahran</option>
                  <option value="S131 - Tamimi Olaya, King Fahad, Riyadh">S131 - Tamimi Olaya, King Fahad, Riyadh</option>
                  <option value="S134 - Tamimi Riyadh">S134 - Tamimi Riyadh</option>
                  <option value="S136 - Tamimi Dabbab, Riyadh">S136 - Tamimi Dabbab, Riyadh</option>
                  <option value="S152 - Tamimi Malaga, Riyadh">S152 - Tamimi Malaga, Riyadh</option>
                  <option value="Jeddah">Jeddah</option>
                  <option value="Riyadh">Riyadh</option>
                  <option value="Dammam">Dammam</option>
                  <option value="Other">Other</option> -->
              </select>
              <input type="text" class="form-control hideNow"  placeholder="Please Specify*" name="ocity-name" id="ocity-name">
            </div>
                            <div id="city-err"></div>
                        </div>
                                      
            
                <div class="form-buttons "><button type="submit" class="submitbtn" name="btnadd" id="submit-button" BackColor="Transparent" >  <img src="assets/images/submit-btn.svg" alt="Submit"></button>
                </div>
        </form>
    </div>

                    <!-- <div class="termsspl">
                <p class="termsClick text-white uppercase">Terms & Conditions Apply </p>
            </div> -->
            </div>
            
                </div>
            </div>
            </section>
                </div>
                
            </main>

            <footer class="footer">
            <div class="container">
            
         </footer>
        </div>
    </div>
    <script>
    window.onload = function() {
        // Get the score from session storage
        let goals = sessionStorage.getItem('goals');

        if (goals) {
            // Send the score to the backend via AJAX
            $.ajax({
                url: 'save_score.php',  // A PHP file to save the score to session
                type: 'POST',
                data: { goals: goals },
                success: function(response) {
                    // You can use the response if needed
                   // console.log('Score saved to session');
                }
            });
        }
    };
</script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/scripts/script.js"></script>
</body>
</html>