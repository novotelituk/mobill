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
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sticky-top"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sticky-top"><!-- <![endif]-->
<head>
  <title>Print Report</title>
  
   <?php include("head_elements.php"); ?>
   <link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/autofill.js"></script>

<script language="JavaScript">
function Check(chk)
{ 
if(document.myform.Check_ctr.checked==true)
{
for (var i = 0; i < chk.length; i++)
{
chk[i].checked = true ;
}
}
else
{
for (i = 0; i < chk.length; i++)
chk[i].checked = false ;
}
}
</script>




<script>
$('.dynamicTable.colVis').dataTable({
  "sPaginationType": "bootstrap",
  "sDom": "<'row-fluid'<'span3'f><'span3'l><'span6'C>r>t<'row-fluid'<'span6'i><'span6'p>>",
  "oLanguage": {
    "sLengthMenu": "_MENU_ per page"
  }
});
</script>
<script language="javascript">
$(document).ready(function() { 
    // call the tablesorter plugin 
    $("table").tablesorter({ 
        // sort on the first column and third column, order asc 
        sortList: [[0,0],[2,0]] 
    }); 
});
   
</script>

</head>
<body>






  <div class="container-fluid fluid menu-left">
    
        
        <!-- Content -->
        <div id="content">
              <?php include("topnav.php"); ?>
              
              <ul class="breadcrumb">
              <li>You are here</li>
              <li><a href="#" class="glyphicons dashboard"><i></i> Quick Admin</a></li>
              <li class="divider"></li>
              <li>Print Report</li>
              <li class="pull-right hidden-phone"><a href="" class="glyphicons shield">Get Help<i></i></a></li>
              <li class="pull-right hidden-phone divider"></li>
              <li class="pull-right hidden-phone"><a href="" class="glyphicons adjust_alt">Filter<i></i></a></li>
              
            </ul>

            
            
           
            
            
         

               
 <div class="innerLR">

  <!-- Widget -->
  <div class="widget widget-heading-simple widget-body-gray">

    <div class="widget-body">
    
      <!-- Table -->
      <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white tablesorter" id="report">
      
        <!-- Table heading -->
        <thead>
          <tr>
            
            
            <th style="width:10px;">Select</th>
            <th style="width:20px;">Item Code</th>
            <th style="width:50px;">Item Name</th>
	          
            <th style="width:40px;">Vendor Name</th>
            
            <th style="width:30px;">Price</th>
            <th style="width:30px;">Qty</th>
            <th style="width:30px;">Discount</th>
            <th style="width:30px;">Total</th>
            
            <th>Save</th>
          </tr>
        </thead>
        <!-- // Table heading END -->
        
        <!-- Table body -->
        <tbody>
        
          
           <?php
          include("../../settings/db.php");
          
          $qrys=mysql_query("SELECT * from `order`") or die("Error querying");
          while($result=mysql_fetch_array($qrys))
            {
              
	      $item_code=$result['order_id'];
        $ven_code=$result['assign_vendor'];
        $sql=mysql_query("SELECT `vendorname` from `vendor_details` WHERE `vendorcode`='$ven_code'") or die("Error querying");
        $row=mysql_fetch_row($sql);
            echo '<tr>
	             
              <td>'.$result['item_code'].'</td>
              <td><div id="checkboxlist"><input id="checkit" class="chk" type="checkbox" value="'.$item_code.'"></div></td>
              <td>'.$result['item_name'].'</td>
	      <td><img src="'.$result['thumbnail'].'" height="40px" width="40px"></td>
              <td>'.$row[0].'</td>
              <td>'.$result['length'].'</td>
              <td>'.$result['breadth'].'</td>
              <td>'.$result['width'].'</td>
              <td>'.$result['height'].'</td>
              <td>'.$result['price'].'</td>
              <form action="?code='.$item_code.'" method="post">
              <td><input type="text" style="width:40px;" name="price1" value="'.$result['p1'].'"></td>
              <td><input type="text" style="width:40px;" name="price2" value="'.$result['p2'].'"></td>
              <td>'.$result['vendor_stock'].'</td>
              <td>'.$result['order_quant'].'</td>
              <td>'.$result['delivery'].'</td>
	      <td><a href="../../vendor/dashboard/comment.php?code='.$item_code.'" target="_blank">Click</a></td>
        <td><input type="submit" name="save" value="Save"></td></form>
              
            </tr>';
            }


            if(isset($_POST['save'], $_GET['code'])){
              $code=$_GET['code'];
              $p1=$_POST['price1'];
              $p2=$_POST['price2'];

              $update_sql=mysql_query("UPDATE `order` SET `p1`='$p1', `p2`='$p2' where `order_id`='$code'") or die("Error in query");
              
            }
            ?>
          
          
        </tbody>
        <!-- // Table body END -->
        
      </table>
      <!-- // Table END -->
     
      
    </div>
  </div>



 </div>





    </div>
</div><!--container fluid-->


</body>
</html>