<?php 
session_start();
if(!isset($_SESSION['login_user'])){
	header("location:../login/");
}
//error_reporting(E_ALL ^ E_NOTICE);
?>
<html>
    <form name="task" action="" method="post">
    Item Code: <input type="text" name="itemcode">
    <input type="submit" name="submit" value="Search">
    </form>
</html>
<?php
if(isset($_POST['submit'])){
include("../../php_includes/db_config.php");
$itemcode=$_POST['itemcode'];
$_SESSION['itemcode']=$itemcode;

$search_craft=mysql_query("SELECT craft_type from item where item_code='$itemcode' LIMIT 1");
while($row_cat=mysql_fetch_array($search_craft)){
$item_cat=$row_cat['craft_type'];
}
echo $item_cat;
$vendor_query=mysql_query("SELECT distinct vendorname from vendor_details, item where (vendor_details.vendor_cat='$item_cat')");
echo '<form name="order" action="action.php" method="post">';
echo    '<table>
        <tr>
        <th>Item Code</th>
        <th>Name</th>
        <th>Image</th>
        <th>Length</th>
        <th>Breadth</th>
        <th>Height</th>
        <th>Width</th>
        <th>Price</th>
        <th>Available</th>
        <th>Assign Vendor</th>
        <th># Stock</th>
        <th>Delivery</th>
        </tr>';
$search_item=mysql_query("SELECT * from item where item_code='$itemcode'");
while($row=mysql_fetch_array($search_item)){
    echo    '<tr>
            <td>'.$row['item_code'].'</td>
            <td>'.$row['item_name'].'</td>
            <td><a href="'.$row['item_image'].'" target="_blank"><img src="'.$row['item_image'].'" height="40px" width="40px"></img></a></td>
            <td>'.$row['length'].'</td>
            <td>'.$row['breadth'].'</td>
            <td>'.$row['height'].'</td>
            <td>'.$row['width'].'</td>
            
            <td>'.$row['price'].'</td>
            <td>'.$row['availstock'].'</td>';
            
}
            
            echo '<td><select name="assign_vendor"><option value="default">--Select a vendor--</option>';
            while($vendor_row=mysql_fetch_array($vendor_query)){
                echo '<option value="';
                $vname=$vendor_row['vendorname'];
                echo $vname.'">'; 
                echo $vname.'</option>';
                
                
            }
            
            echo '</select></td>
                <td><input type="text" name="stockorder"></td>
                <td><input type="date" name="delivery"></td>
                <td><input type="submit" name="order" value="Order"></td>
                
            ';
            echo '</tr>'; 



echo '</select>';
echo '</table>
</form>';
$order_item_code=$row['item_code'];
$order_item_name=$row['item_name'];
echo "appap";
}

?>

