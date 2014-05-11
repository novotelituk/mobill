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
  //$_SESSION['fbid']=$user_id;
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
<div style="width: 120px;margin: auto;padding-top: 150px;text-align:center;">
<a href="<? echo $login_url; ?>"><img src="connect.jpg" style="width:210px;"></a>
</div>