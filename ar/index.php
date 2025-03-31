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

include("../snickersAdmin987/includes/conn.php"); 

$arabic=1;





$prevspiId = isset($_GET['spinid']) ? $_GET['spinid'] : '';
if ($prevspiId) {
    $prevEntrySql = "select * from `".TB_pre."shop_win` WHERE `spin_id` = '$prevspiId' ";
  //  var_dump($prevEntrySql); die;
  $prevEntryR1=mysqli_query($url,$prevEntrySql) or die("Failed".mysqli_error($url));
  $prevEntryRes = mysqli_fetch_array($prevEntryR1);	
  //var_dump($prevEntryRes); exit;
  
    $firstName=$prevEntryRes['first_name'];	
	$lastName=$prevEntryRes['last_name'];	
    $email=$prevEntryRes['email'];
    $country='KSA';
    $gender=$prevEntryRes['gender'];
    $city=$prevEntryRes['emirate'];
    $mobile=$prevEntryRes['mobile'];
    
	$series=0;  
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
<body class="form-page innerpages">
    <div class="outer-wraper">
    <?php include_once('./inc/terms-ar.php'); ?>
        <!-- popup ends-->
        <div class="main-container">
        
            <main class="main">
            <div class="header">
                <img src="../assets/images/form-header.webp" alt="Win with Pert plus" class="img-fluid fadeinimages lefttorightfade">
                <div class="winwithtxt">
                <img src="../assets/images/win-with-pert-ar.svg" alt="Win with Pert plus" class="img-fluid inout">
                </div>
            </div>
                <div class="win-cash fadeinimages">
                    <img style="margin-bottom: 15px;" class="img-fluid" src="../assets/images/fill-form.svg" alt="املأ النموذج لدخول السحب و اربح
قسيمة YouGotAgift بقيمة 100 ريال سعودي">
                    <!-- <h2 class="text-white">املأ النموذج لدخول السحب و اربح
<br>ريال سعودي <span class="english">100</span>بقيمة <span class="english">YouGotAgift</span> قسيمة 
                    </h2> -->
                  
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
                
                
            <form role="form" method="post"  class="form-horizontal " action="submit.php" enctype="multipart/form-data" id="submitForm" >
     
                        <input type="<?php echo $prevspiId ? 'hidden' : 'text'; ?>" class="form-control" placeholder="الاسم و اللقب" name="first-name" id="first-name" required <?php if ($prevspiId) {echo 'value="' . $firstName . '"';} ?> />
                            <div id="fname-err"></div>
                     
          

                                    <input type="<?php echo $prevspiId ? 'hidden' : 'tel'; ?>" name="mobile" class="form-control inputmobile" id="inputNumber" placeholder="رقم الهاتف" required <?php if ($prevspiId) {echo 'value="' . $mobile . '"';} ?> >
                <div id="mobile-err"></div>

                      <input type="<?php echo $prevspiId ? 'hidden' : 'email'; ?>" class="form-control" placeholder="البريد الالكتروني" name="email" id="inputEmail4" required <?php if ($prevspiId) {echo 'value="' . $email . '"';} ?> />
                        <div id="email-err"></div>

                         
                <?php if ($prevspiId) { ?>
                    <input type="hidden" name="gender" value="<?php echo $gender; ?>" >
                    <?php } else { ?>
                <select class="form-select form-control" name="gender" id="gender">
                    <option value="" selected>الجنس</option>
                    <option value="Male">ذكر</option>
                    <option value="Female">أنثى</option> 
                </select>
                <?php } ?>
                <div id="gender-err"></div>
                
                <?php if ($prevspiId) { ?>
                    <input type="hidden" name="city" value="<?php echo $city; ?>" >
                    <?php } else { ?>
                <select class="form-select form-control" name="city" id="city">
                  
                  <option value="" selected>المنطقة</option>
                  <option value="Jeddah">جدة </option>
                  <option value="Riyadh">الرياض </option>
                  <option value="Dammam">الدمام </option>
                  <option value="Makkah">مكة  </option>
                  <option value="Madinah">المدينة المنورة</option>
                  <option value="Khobar">الخبر  </option>
                  <option value="Qassim">القصيم  </option>
                  <option value="Abha">أبها  </option>
                  <option value="Jizan">جازان  </option>
                  <option value="Taif">الطائف  </option>
                  <option value="Tabuk">تبوك  </option>
                  <option value="Other">أخرى</option>
                </select>

                <?php } ?>
                <input type="text" class="form-control hideNow"  placeholder="الرجاء تحديد المنطقة" name="ocity-name" id="ocity-name">
            <div id="city-err"></div>
                <div id="city-err"></div>

               
                        <div class="form-check custom-control custom-radio radio-btn mb-5">
                        <label>
    <input type="radio" name="customRadio1" id="customRadio1" class="custom-control-input form-check-input" required>
    <span class="text-green">لقد قرأت، فهمت و وافقت على</span>
   <br> <span class="termsClick text-green">الاحكام و الشروط</span>
</label>

    
</div>
<div id="accept-err"></div>
            
                <div class="form-buttons"><button type="submit" class="actionBtn submitnreset" name="btnadd" id="submit-button" BackColor="Transparent" >ارسال</button>
                <button type="reset" class="actionBtn submitnreset" name="btnreset" id="reset-button" BackColor="Transparent" >ضبط</button>
                </div>
                </div>  
                        
                    </div><!-- /.box-body -->

                    
                    </form>
                    <!-- <div class="termsspl">
                <p class="termsClick text-white uppercase">Terms & Conditions Apply </p>
            </div> -->
            <div class="termsspl">
                    <p class="termsClick text-white lowercase">الأحكام و الشروط </p>
                </div>
            </div>
            
                </div>
            </div>
            </section>
                
            </main>

            <footer class="footer">
            <div class="container">
            
         </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../assets/scripts/script-ar.js"></script>
</body>
</html>