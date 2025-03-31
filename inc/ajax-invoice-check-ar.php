<?php  
ob_start();
include("../snickersAdmin987/includes/conn.php"); 
$output = '';



// $invZone = $_POST["zone"];
$invoice = $_POST["invoice"];
// var_dump($invoice); die;

if(isset($invoice))
{
 //$search = mysqli_real_escape_string($url, $_POST["invoice"]);
 $search = mysqli_real_escape_string($url, $invoice);

 $query = "
  SELECT * FROM `".TB_pre."shop_win` 
  WHERE invoice_no='$search'
 ";

}

$result = mysqli_query($url, $query);

if(mysqli_num_rows($result) > 0)
{
 $output .= '<p class="errormsg">تم تقديم رقم الفاتورة هذا مسبقًا</p>';
 echo $output;
} 
?>

