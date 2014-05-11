<?php 
session_start();
if(!isset($_SESSION['login_user'])){
	header("location:../login/");
}
//error_reporting(E_ALL ^ E_NOTICE);
include("../../php_includes/db_config.php");
$assign_vendor=$_POST['assign_vendor'];
$stockorder=$_POST['stockorder'];
$delivery=$_POST['delivery'];
$itemcode= $_SESSION['itemcode'];

$search_item=mysql_query("SELECT * from item where item_code='$itemcode'");
while($row=mysql_fetch_array($search_item)){
            $itemname=$row['item_name'];
            $itempic=$row['item_image'];
            $itemlength=$row['length'];
            $itembreadth=$row['breadth'];
            $itemheight=$row['height'];
            $itemwidth=$row['width'];
            
            $itemprice=$row['price'];
            $itemstock=$row['availstock'];
	    $image_path="../../admin/dashboard"
            
}
if(isset($_POST['order'])){
	$order_sql=mysql_query("INSERT INTO `order`(`order_id`, `item_code`, `item_name`, `item_pic`, `length`, `breadth`, `width`, `height`, `price`, `assign_vendor`, `order_quant`, `vendor_stock`,`delivery`, `order_time`, `status`) VALUES ('','$itemcode','$itemname','$itempic','$itemlength','$itembreadth','$itemwidth','$itemheight','$itemprice','$assign_vendor','$stockorder','','$delivery',NOW(),'incomplete')");
echo '<h2>YOUR ORDER HAS BEEN PLACED SUCCESFULLY TO <em>'.$assign_vendor.'</em> FOR <em>'.$stockorder.'</em> NUMBER OF <em>'.$itemname.'</em> TO BE DELIVERED BEFORE <em>'.$delivery.'</em> </h2>';
if (!$order_sql) {
    die('Invalid query: ' . mysql_error());
}}
?>