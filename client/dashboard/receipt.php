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

 if(isset($_GET['id']))
 {
 	$id=$_GET['id'];
 }
$sql_user=mysql_query("SELECT * from `user`") or die("error");
while($user_row=mysql_fetch_array($sql_user))
{
	$username=$user_row['user_name'];
	$userfbid=$user_row['fb_id'];
	echo '<h4>Select a user from the list</h4>';
	echo '<a href="?userid='.$userfbid.'">'.$username.'</a> ';
	echo '<br/>';
}
if(isset($_GET['userid']))
{
	//session_start();
	$userfb=$_GET['userid'];
	$_SESSION['useradd']=$userfb;
	
}
echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/>';
?>



<form name="search" method="get" action="" >
Search an item:<br/>
<input type="text" name="search_submit" placeholder="Enter Item ID/Name to search">
<input type="submit" name="submit" value="Search">
</form>

<table cellpadding="1" cellspacing="0">
                      <tr >
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                       
                        
                    </tr>




                    
          <?php
                    error_reporting (E_ALL ^ E_NOTICE);
                    
                    if(isset($_GET['submit']) && !empty($_GET['search_submit'])){
                    $search_submit=$_GET['search_submit'];
                    $query="SELECT * from product where prod_id LIKE '"."%".$search_submit."%"."' or prod_name LIKE '"."%".$search_submit."%"."' ";
                    $search_result=(mysql_query($query));
                    
   if(!$search_result){
   die(mysql_error());
   }             
            while($show_found_members=mysql_fetch_array($search_result)){
                
               $pid=$show_found_members['prod_id'];
            	
           echo' <tr>
           		<form method="post" action="?pid='.$pid.'">
                <td>'.$show_found_members['prod_id'].'</td>
                <td>'.$show_found_members['prod_name'].'</td>
                <td>'.$show_found_members['prod_mrp'].'</td>
                
                <td><input type="text" name="qty"></td>
                <td><input type="submit" name="sell" value="Sell"></td></form>
            </tr>
           ';
            }}
           ?>
</table>

<?php 
if(isset($_POST['sell']))
{
	$userdb=$_SESSION['useradd'];
	$pid=$_GET['pid'];
	$qty=$_POST['qty'];
	$prod_sql=mysql_fetch_row(mysql_query("SELECT `prod_mrp`, `prod_client_id` FROM `product` WHERE `prod_id`='$pid'")) or die("Error");
	 $mrp= $prod_sql[0];
	 $shop_mail=$prod[1];
	 $price=$mrp*$qty;
	$update_sql=mysql_query("INSERT INTO `transaction` (tr_prod_id, qty, tr_price, tr_user_id, tr_client_id) values('$pid','$qty','$price','$userdb','$ven_mail')") or die("error");
	header("Location: receipt.php");
}
?>