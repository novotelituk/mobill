<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../settings/db.php');
if(!isset($_SESSION['fbid'])){
	header("Location: ../login/");
}
$fbid=$_SESSION['fbid'];

if(isset($_GET['shopcode']))
{
	$code=$_GET['shopcode'];

}
$sql_shop=mysql_query("SELECT `client_email` from `client` WHERE `client_id`='$code'") or die("error");
$row=mysql_fetch_array($sql_shop);
$shopmail=$row[0];

$sql_trans=mysql_query("SELECT * from `transaction` WHERE `tr_client_id`='$shopmail' AND `tr_user_id`='$fbid'") or die("Error");
if((mysql_num_rows($sql_trans)>0))
{
echo '<table border=1><tr>
<td>Receipt ID</td>
<td>Item ID</td>
<td>Item Name</td>
<td>Qty</td>
<td>Price</td></tr>
';
while($res=mysql_fetch_array($sql_trans))
{	
	$prod_id=$res['tr_prod_id'];
	$sql_prod=mysql_fetch_row(mysql_query("SELECT `prod_name` from `product` where `prod_id`='$prod_id'"));
	$prod_name=$sql_prod[0];
	echo 
	'<tr><td>'.$res['tr_id'].'</td>
	<td>'.$res['tr_prod_id'].'</td>
	<td>'.$prod_name.'</td>
	<td>'.$res['qty'].'</td>
	<td>'.$res['tr_price'].'</td></tr>
	';
	
}
	
echo '</table>';	
}
elseif((mysql_num_rows($sql_trans)==0))
{
	echo "You have not purchased anything from this shop!";
}
?>