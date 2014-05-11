<?php 
session_start();
if(!isset($_SESSION['login_user'])){
    header("location:../login/");
}
error_reporting(E_ALL ^ E_NOTICE);
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sticky-top"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sticky-top"><!-- <![endif]-->
<head>
    <title>Add Client</title>
    
    <!-- Meta -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    
    <!-- Bootstrap -->
    <link href="../common/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../common/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
    
    <!-- Glyphicons Font Icons -->
    <link href="../common/theme/fonts/glyphicons/css/glyphicons.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="../common/theme/fonts/font-awesome/css/font-awesome.min.css">
    <!--[if IE 7]><link rel="stylesheet" href="../common/theme/fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
    
    <!-- Uniform Pretty Checkboxes -->
    <link href="../common/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" rel="stylesheet" />
    
    <!-- PrettyPhoto -->
    <link href="../common/theme/scripts/plugins/gallery/prettyphoto/css/prettyPhoto.css" rel="stylesheet" />
    
    <!-- Main Theme Stylesheet :: CSS -->
    <link href="../common/theme/css/style-default.css?1372280974" rel="stylesheet" type="text/css" />
    
    
    <!-- LESS.js Library -->
    <script src="../common/theme/scripts/plugins/system/less.min.js"></script>
    <script>
        $(document).ready(function(){
          setTimeout(function(){
          $("div#notify").fadeOut("slow", function () {
          $("div#notify").remove();
              });

        }, 5000);
         });
 
     </script>
     <style>
        #notify{
        width: 100%;
        position: fixed;
        bottom: 0px;
        z-index: 1000;
        background-color: #4a8bc2;
        color: #1c1c1c;
        
        
        }
        
        #notify p{
        width: 1000px;
                margin: auto;
                padding: 10px;
                text-align: center;
                font-size: 15px;
                color: #fff;
        }
     </style>
</head>
<body class="login ">
    
    <!-- Wrapper -->
<div id="login">

    <div class="wrapper signup">
        
            <h1 class="glyphicons user_add">Add Client <i></i></h1>
        
            <!-- Box -->
            <div class="widget widget-heading-simple">
                
                <div class="widget-head" style="margin-bottom:10px;">
                    <h3 class="heading">Create Client Account</h3>
                    
                </div>
                <div class="widget-body">
        
                    <!-- Form -->
                    <form method="post" name="client" action="" method="post" enctype="multipart/form-data">
                    
                    <!-- Row -->
                    <div class="row-fluid row-merge">
                    
                        <!-- Column -->
                        <div class="span6">
                            <div class="innerR">
                                <label class="strong">Client Name</label>
                                <input type="text" name="vendorname" class="input-block-level" placeholder="vendor username"/>
                                <label class="strong">Email</label>
                                <input type="text" name="email" class="input-block-level" placeholder="Your Email Address"/>
                                <label class="strong">Confirm Email</label>
                                <input type="text" name="reemail" class="input-block-level" placeholder="Confirm Your Email Address"/>
                                <input type="submit" name="submit" class="btn btn-icon-stacked btn-block btn-success" value="Create Account" />
                            </div>
                        </div>
                        <!-- // Column END -->
                        
                        <!-- Column -->
                        
                        <!-- // Column END -->
                        
                    </div>
                    <!-- // Row END -->
                    
                    </form>
                    <!-- // Form END -->
           
        
                </div>
                <!-- // Box END -->
                <span style="float:right;margin-top:30px;"><a href="index.php" class="btn btn-default btn-icon glyphicons left_arrow"><i></i>Back to Dashborad</a></span>
            </div>
            
    </div>
    
</div>
<!-- // Wrapper END --> 

<!-- Themer -->
<div id="themer" class="collapse">
    <div class="wrapper">
        <span class="close2">&times; close</span>
        <h4>Themer <span>color options</span></h4>
        <ul>
            <li>Theme: <select id="themer-theme" class="pull-right"></select><div class="clearfix"></div></li>
            <li>Primary Color: <input type="text" data-type="minicolors" data-default="#ffffff" data-slider="hue" data-textfield="false" data-position="left" id="themer-primary-cp" /><div class="clearfix"></div></li>
            <li>
                <span class="link" id="themer-custom-reset">reset theme</span>
                <span class="pull-right"><label>advanced <input type="checkbox" value="1" id="themer-advanced-toggle" /></label></span>
            </li>
        </ul>
        <div id="themer-getcode" class="hide">
            <hr class="separator" />
            <button class="btn btn-primary btn-small pull-right btn-icon glyphicons download" id="themer-getcode-less"><i></i>Get LESS</button>
            <button class="btn btn-inverse btn-small pull-right btn-icon glyphicons download" id="themer-getcode-css"><i></i>Get CSS</button>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- // Themer END -->

    <!-- JQuery -->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    
    <!-- Code Beautify -->
    <script src="../common/theme/scripts/plugins/other/js-beautify/beautify.js"></script>
    <script src="../common/theme/scripts/plugins/other/js-beautify/beautify-html.js"></script>
    
    <!-- PrettyPhoto -->
    <script src="../common/theme/scripts/plugins/gallery/prettyphoto/js/jquery.prettyPhoto.js"></script>
    
    <!-- Global -->
    <script>
    var basePath = '',
        commonPath = '../common/';
    </script>
    
    
    <!-- Modernizr -->
    <script src="../common/theme/scripts/plugins/system/modernizr.js"></script>
    
    <!-- Bootstrap -->
    <script src="../common/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- SlimScroll Plugin -->
    <script src="../common/theme/scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js"></script>
    
    <!-- Common Demo Script -->
    <script src="../common/theme/scripts/demo/common.js?1372280974"></script>
    
    <!-- Holder Plugin -->
    <script src="../common/theme/scripts/plugins/other/holder/holder.js"></script>
    <script>
        Holder.add_theme("dark", {background:"#000", foreground:"#aaa", size:9});
        Holder.add_theme("white", {background:"#fff", foreground:"#c9c9c9", size:9});
    </script>
    
    <!-- Uniform Forms Plugin -->
    <script src="../common/theme/scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script>

    
    
</body>
</html>

<?php
include("../../settings/db.php");
$vendorname=$_POST["vendorname"];
$vendoremail=$_POST["email"];
$revendoremail=$_POST["reemail"];

$add_query=mysql_query("SELECT * from client WHERE client_email='$vendoremail'");
if(isset($_POST["submit"]) && ($vendoremail==$revendoremail)){
    
    if(mysql_num_rows($add_query) ==0){
    $temp_pass=mt_rand(10000000,99999999);
    echo $temp_pass;
    $sql=mysql_query("INSERT into client(client_id, client_name, client_email, client_pass, client_creation, client_log_flag) values('','$vendorname', '$vendoremail',SHA('$temp_pass'), NOW(), '0')") or die("Error query");
    echo '<div id="notify"><p>Client Added</p></div>';
    
    
    
$to = "$vendoremail, vms@indiancraftsmanship.com";
$subject = "Craftsman Account Created at Indian Craftsmanship";

$message = "
<html>
<head>
<title>Indian Craftsmanhip</title>
</head>
<body>
<p>Dear $vendorname,<br> Welcome to MoBill. We value your associataion and we would like to grow along with you in our business pursuit. We believe in fair business practice and wish best of your association in future time. Your account details have been given below. </p>
<p>To login please use your Vendor Code: $vendorcode and password $password  <a href='http://vms.indiancraftsmanship.com/vendor/login/'>CLICK HERE TO GO TO YOUR LOGIN DASHBOARD<a></p>
<table border=1>
<tr>
<th>Code</th>
<th>Name</th>
<th>Email</th>
<th>Password</th>
</tr>
<tr>
<td>$vendorcode</td>
<td>$vendorname</td>
<td>$vendoremail</td>
<td>$password</td>
</tr>
</table>
<p><i>For VMS and any doubt in that please feel free to mailback at vms@indiancraftsmanship.com</i></p>
<p>Thanks,</p>
<p><b>Amar Bikram Nayak</b><br><i>Indian Craftsmanhip</i></p>


</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
$headers .= 'From: <vms@indiancraftsmanship.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);

    }
    else echo '<div id="notify"><p>Code has been used.</p></div>';
}
elseif(isset($_POST['submit'])){
    echo '<div id="notify"><p>Please fill all the fields properly!</p></div>';
}
 
 
?>