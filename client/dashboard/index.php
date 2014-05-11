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
$trans_sql=mysql_query("SELECT `tr_id` from `transaction` ORDER BY `tr_id` DESC") or die("error");
$row_trans=mysql_fetch_row($trans_sql);
$tr_link_id=$row_trans[0]+1;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard- MoBill</title>
</head>
<body>
<a href="receipt.php?id=<? echo $tr_link_id ?>">New Receipt</a>
</body>
</html>


<?php ob_flush(); ?>