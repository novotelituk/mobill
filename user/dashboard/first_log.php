<?php
ob_start();
session_start();
include("../../settings/db.php");
$user_id=$_SESSION['fbid'];
$check_sql=mysql_query("SELECT `user_log_flag` from `user` where `fb_id`='$user_id'") or die("Error");
$res_check_sql=mysql_fetch_row($check_sql);
  
if($res_check_sql[0]=='1'){
   
    header("Location: ../dashboard/index.php");
  }


?>

<html>
	<form name="first" action="" method="post">
		10-digit Phone Number: <input type="text" name="phone"><br/>
		
		<input type="submit" name="submit" value="Add">
	</form>
</html>

<?php
$phone=$_POST['phone'];


if(isset($_POST['submit']) && !empty($phone) && (strlen($phone)==10)){
	$sql=mysql_query("UPDATE `user` SET `user_phone`='$phone'") or die("Error in query");
	if(mysql_affected_rows()=='1'){
		$sql_flag=mysql_query("UPDATE `user` SET `user_log_flag`='1'") or die("Error");
		//$_SESSION['first_login']=='false';
		echo "Phone number saved successfully. Redirecting you to the dashboard in 5 seconds...";
		 $_SESSION['first_login'];
		header( "refresh:5;url=index.php" );
	}
}
?>