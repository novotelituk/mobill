<?php
ob_start();
session_start();

if(!isset($_SESSION['login_user'])){
	header("location:../login/");

}
include("../../settings/db.php");
$client_log=$_SESSION['login_user'];
$ven_sql=mysql_query("SELECT * from `client` where `client_email`='$client_log'") or die("Error");
while($row_ven_details=mysql_fetch_array($ven_sql)){
    $ven_mail= $row_ven_details['client_email'];
    $client_name=$row_ven_details['client_name'];
    //echo $ven_mail;
 
}
?>
<?php
if($_POST){
    
    $itemname=$_POST['itemname'];
    
   
    $mrp=$_POST['mrp'];
    $cp=$_POST['cp'];
    $sp=$_POST['sp'];
    $stock=$_POST['stock'];
    
    //echo $code;
    echo $itemname ;
   echo  $mrp;
    //echo "succ";
    $update_sql=mysql_query("INSERT into `product` (prod_name, prod_mrp,prod_cp, prod_sp, prod_stock, prod_client_id) values('$itemname','$mrp','$cp',$sp','$stock','$ven_mail')") or die("Error in query");
    
    $to = "vms@indiancraftsmanship.com, $ven_mail ";
$subject = "New ACTIVITY at VMS in Indian Craftsmanship";
$txt = "Hello there,<br/> There's a new activity in $ven_name VMS account at Indian Craftsmanship. Please login to your VMS account to check it.";
$headers = "From: vms@indiancraftsmanship.com" . "\r\n" ;

mail($to,$subject,$txt,$headers);

    header("Location:index.php");
					    }

			    ?>