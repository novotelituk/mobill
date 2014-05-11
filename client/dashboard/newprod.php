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
    <title>Dashboard-MoBill</title>

      <?php include("head_elements.php");
      ?>
    



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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js">
</script>
<script type="text/javascript" >
$(function() {
$(".submit").click(function() {
var itemname = $("#itemname").val();
var mrp = $("#mrp").val();
var cp = $("#cp").val();
var sp = $("#sp").val();
var stock = $("#stock").val();
var dataString = 'itemname='+ itemname + '&cp=' + cp + '&mrp=' + mrp + '&sp=' + sp + '&stock=' + stock;

if(itemname=='' || mrp=='' || sp=='' || stock=='' || cp=='')
{
$('.success').fadeOut(200).hide();
$('.error').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "add.php",
data: dataString,
success: function(){
$('.success').fadeIn(200).show();
$('.error').fadeOut(200).hide();
}
});
}
return false;
});
});
</script>

</head>
<body class="">
    
        <!-- Main Container Fluid -->
    <div class="container-fluid fluid menu-left">
        
               
        <!-- Content -->
        <div id="content">
        
                <?php include("topnav.php");
		
                            $order_query="SELECT * FROM `product` where `prod_client_id`='$ven_mail' ORDER BY prod_id DESC";
                            $run_sql=mysql_query($order_query) or die("Error");
			    ?>
                
    <ul class="breadcrumb">
    <li>You are here</li>
    <li><a href="#" class="glyphicons dashboard"><i></i>Vendor</a></li>
    <li class="divider"></li>
    <li>Dashboard</li>
    <li class="pull-right hidden-phone"><a href="" class="glyphicons shield">Get Help<i></i></a></li>
    <li class="pull-right hidden-phone divider"></li>
    <li class="pull-right hidden-phone"><a href="" class="glyphicons adjust_alt">Filter<i></i></a></li>
</ul>


<h2>Dashboard <span> MoBill</span></h2>

                <div class="innerLR">

                  <h3 style="margin-bottom: 80px;text-align:center;">Welcome, <?php echo $client_name; ?></h3>
                    
                     <table border=1 class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white tablesorter" id="report">
			
			   
			    
			    <td>Name</td>
			    <td>MRP</td>
			    <td>Cost Price</td>
			    <td>Selling Price</td>
			    <td>Stock</td>
			    
			    
			   			    
			    <td>Save</td>
			   
			
			
      <?php

      echo '
      <tr>
      <form name="add" method="post" action="add.php"> 
      <td> <input type="text" id="itemname" name="itemname"> </td>
      <td><input type="text" id="mrp" name="mrp"></td>
      <td><input type="text" id="cp" name="cp"></td>  
      <td> <input type="text" id="sp" name="sp"> </td>
      <td><input type="text" id="stock" name="stock"></td> 
      <td><input type="submit" class="submit" value="Save"></td>
      <span class="error" style="display:none"> Please Enter Valid Data</span>
      <span class="success" style="display:none"> Product Added.</span>
      </tr>';
      ?>
			    
			    
			    

			
			
		     </table>
		    
                           <div align="center" id="err"><!--Upload-->

   <div id="space"></div>
   
 
  
  
  
 

	

                        <div class="row-fluid" style="margin-top:120px;text;align:center;">
                             <div class="span4" style="float:right;">
                              <h4>Last Login : <?php echo $last_login; ?></h4>
                             </div>
                        </div>


                       </div>
                </div>



</div>     <!--content end-->
 <?php include("footer.php"); ?>

</div>     <!--container end-->


  


</body>
</html>
<?php ob_flush(); ?>