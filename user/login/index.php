<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('sdk/facebook.php');
  require_once('../../settings/db.php');

  $config = array(
    'appId'  => '270827223099013',
    'secret' => '99991d817b7c8961b0055fb60158fa9a',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );
$facebook= new Facebook($config);
$user_id=$facebook->getUser();
if($user_id) 
{   
$check_sql=mysql_query("SELECT `fb_id` FROM `user` WHERE `fb_id`='$user_id'") or die("Error0"); 

if(mysql_num_rows($check_sql)<1)
{
$ip=$_SERVER['SERVER_ADDR'];  
$user= $facebook->api("/me","GET");

$_SESSION['fbid']=$user_id;
$user_name=$user['name'];
$user_location=$user['location']['name']; 
$fb_user_name=$user['username'];
$email=$user['email'];

//$user_pic="https://graph.facebook.com/{$fb_user_name}/picture?height=40&width=40";

$insert_sql=mysql_query("INSERT into `user` (fb_id, user_name, user_location, user_creation, user_ip, user_log_flag, user_email) values('$user_id','$user_name','$user_location',NOW(), '$ip','0','$email')") or die("Error1");

}
  
  $check_sql=mysql_query("SELECT `user_log_flag` from `user` where `fb_id`='$user_id'") or die("Error");
  $res_check_sql=mysql_fetch_row($check_sql);
  
  if($res_check_sql[0]=='0'){
   
    header("Location: ../dashboard/first_log.php");
  }
  elseif($res_check_sql[0]=='1'){
  $_SESSION['fbid']=$user_id;
  header("location:../dashboard");
    //echo $user_id;
                
   }




}
else
{
  $login_url= $facebook->getLoginUrl(array("scope"=>"email,user_location,user_hometown"));
  //echo "<a href='$login_url'>Login with Facebook</a>";
}
?>

<!DOCTYPE html>

<!-- BEGIN HTML -->

<html dir="ltr" lang="en-US">

<head>


<meta charset="utf-8">

<!-- PAGE TITLES -->

<title>Mobill</title>

<!-- META -->

<meta name="description" content="your description" />

<meta name="keywords" content="your keywords" />

<!-- MAIN CSS -->

<link href="style.css" rel="stylesheet" type="text/css" />

<!-- FONTS -->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>

<!-- SHORTCUT ICONS -->

<link REL="SHORTCUT ICON" HREF="images/favicon.ico">

<link rel="apple-touch-icon-precomposed" href="images/iphoneicon.png">

</head>

<body>

<div id="headerbg"></div><!-- END HEADER BACKGROUND -->

<div id="container">

	<header>

		<img src="images/logo.png">

		<a id="button" href="<? echo $login_url; ?>">FB Login</a>

	</header>


  <h1 style="font-size:30px;color:white;text-align:center;padding-top:50px;"> bills in your mobile. </h1>

	<div id="content">


		<img src="images/app.png">
		<p>moBill is a prototype developed in AngelHack Spring 2014 in a Saturday Night!</p>
	</div><!-- END CONTENT -->

</div><!-- END CONTAINER -->

	<footer>
		<p>© 2014 Found - <a href="#">Twitter</a> - <a href="#">Facebook</a></p>
	</footer>

</body>

</html>