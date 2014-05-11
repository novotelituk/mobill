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
</head>
<body class="">
    
        <!-- Main Container Fluid -->
    <div class="container-fluid fluid menu-left">
        
               
        <!-- Content -->
        <div id="content">
        
                <?php include("topnav.php");
		
                            $order_query="SELECT * FROM `product` where `prod_client_id`='$ven_mail' ORDER BY prod_name ASC";
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
			
			    <td>Prod ID</td>
			    
			    <td>Name</td>
			    <td>MRP</td>
			    <td>Cost Price</td>
			    <td>Selling Price</td>
			    <td>Stock</td>
			    
			    <td>Delete</td>
			   			    
			    <td>Save</td>
			   
			
			<tr>
			    <?php while($row_order=mysql_fetch_array($run_sql)){
                              $order_id=$row_order['prod_id'];
                              echo    '

                              <style>
			       input[type=text]{
				 width:50px;
			       }
			      </style>

                                  <tr>
					<form action="?code='.$order_id.'" method="post">
                                        <td>'.$row_order['prod_id'].'</td>
					
                                        <td>'.$row_order['prod_name'].'</td>
                                        
                                        <td><input type="text" name="mrp" style="width:150px;" placeholder="Len:A Bre:B Hei:C Wid:D" value="'.$row_order['prod_mrp'].'"></td>
                                        
                                        <td><input type="text" name="cp" value="'.$row_order['prod_cp'].'"></td>
                                        <td><input type="text" name="sp" value="'.$row_order['prod_sp'].'"></td>
                                        
					<td><input type="text" name="stock" value="'.$row_order['prod_stock'].'"></td>
					
                                 
				  <td><a href="deleteorder.php?code='.$order_id.'">Delete</a></td>
				 
                                  
				    <td><input type="submit" name="save" value="Save"></td></form>';
				    
                                 
				
                            }
			    
			    
			    

if(isset($_POST['save'], $_GET['code'])){
    $code=$_GET['code'];
    $itemname=$_POST['itemname'];
    
   
    $mrp=$_POST['mrp'];
    $cp=$_POST['cp'];
    $sp=$_POST['sp'];
    $stock=$_POST['stock'];
    
    echo $code;
    //echo "succ";
    $update_sql=mysql_query("UPDATE `product` SET  `prod_mrp`='$mrp',`prod_cp`='$cp', `prod_sp`='$sp', `prod_stock`='$stock' where `prod_id`='$code'") or die("Error in query");
    
    $to = "vms@indiancraftsmanship.com, $ven_mail ";
$subject = "New ACTIVITY at VMS in Indian Craftsmanship";
$txt = "Hello there,<br/> There's a new activity in $ven_name VMS account at Indian Craftsmanship. Please login to your VMS account to check it.";
$headers = "From: vms@indiancraftsmanship.com" . "\r\n" ;

mail($to,$subject,$txt,$headers);

    header("Location:edit.php");
					    }

			    ?>
			</tr>
			
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