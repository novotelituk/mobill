<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../settings/db.php');
if(!isset($_SESSION['fbid'])){
	header("Location: ../login/");
}
$fbid=$_SESSION['fbid'];




$sql_trans=mysql_query("SELECT * from `transaction` WHERE `tr_user_id`='$fbid'") or die("Error");
if((mysql_num_rows($sql_trans)>0))
{
echo '<table border=1><tr>
<td>Receipt ID</td>
<td>Item ID</td>
<td>Item Name</td>
<td>Shop Name</td>
<td>Qty</td>
<td>Price</td></tr>
';
while($res=mysql_fetch_array($sql_trans))
{	
	$prod_id=$res['tr_prod_id'];
	$client_id=$res['tr_client_id'];
	$sql_shop=mysql_query("SELECT `client_name` from `client` WHERE `client_email`='$client_id'") or die("error");
	$row=mysql_fetch_array($sql_shop);
	$shopname=$row[0];
	$sql_prod=mysql_fetch_row(mysql_query("SELECT `prod_name` from `product` where `prod_id`='$prod_id'"));
	$prod_name=$sql_prod[0];
	echo 
	'<tr><td>'.$res['tr_id'].'</td>
	<td>'.$res['tr_prod_id'].'</td>
	<td>'.$prod_name.'</td>
	<td>'.$shopname.'</td>
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