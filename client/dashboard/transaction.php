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
             <th>Receipt Id</th>
             <th>Customer Name</th>
             <th>Customer Email</th>
            <th>Item Code</th>
           
            <th>Item Name</th>
	          
            <th>Qty</th>
            <th>Price</th>
            
          </tr>
        </thead>
        <!-- // Table heading END -->
        
        <!-- Table body -->
        <tbody>
        
          
           <?php
          include("../../settings/db.php");
          
          $qrys=mysql_query("SELECT * from `transaction` where `tr_client_id`='$ven_mail'") or die("Error querying");
          while($result=mysql_fetch_array($qrys))
            {
         $tr_user_id=$result['tr_user_id']; 
        $tr_id=$result['tr_id'];      
	      $item_code=$result['tr_prod_id'];
        $qty=$result['qty'];
        $tr_price=$result['tr_price'];
        $sql_prod=mysql_fetch_row(mysql_query("SELECT `prod_name` from `product` where `prod_id`='$item_code'")) or die("Error2");
        $prod_name=$sql_prod[0];
        $sql_cust=mysql_query("SELECT `user_name`,`user_email` from `user` where `user_id`='$tr_user_id'") or die("Error!");
        $row_sql=mysql_fetch_row($sql_cust);
        

        //$ven_code=$result['assign_vendor'];
        //$sql=mysql_query("SELECT * from `vendor_details` WHERE `vendorcode`='$ven_code'") or die("Error querying");
        $row=mysql_fetch_row($sql);
            echo '<tr>
	             
              <td>'.$tr_id.'</td>
              
              <td>'.$row_sql[0].'</td>
	      <td>'.$row_sql[1].'</td>
              
              
             
              <td>'.$item_code.'</td>
              <td>'.$sql_prod[0].'</td>
              <td>'.$qty.'</td>
	      <td>'.$tr_price.'</td>
       
              
            </tr>';
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
