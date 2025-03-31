<?php  
ob_start();
include("../PersilAdmin/includes/conn.php"); 
$output = '';



$mobile = $_POST["email"];


if(isset($mobile))
{

 //$search = mysqli_real_escape_string($url, $_POST["invoice"]);
 $search = mysqli_real_escape_string($url, $mobile);

 $query = "
  SELECT * FROM `".TB_pre."shop_win` 
  WHERE email='$search'
 ";
}

$result = mysqli_query($url, $query);

if(mysqli_num_rows($result) > 0)
{

 $output .= '
 <input type="hidden" name="emailexists" value="1">';
 echo $output;
} 
?>

