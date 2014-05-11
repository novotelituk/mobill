<?php
ob_start();
session_start();
include("../../settings/db.php");
$client_email=$_SESSION['login_user'];
echo $client_email;
$check_sql=mysql_query("SELECT `client_log_flag` from `client` where `client_email`='$client_email'") or die("Error");
$res_check_sql=mysql_fetch_row($check_sql);
  
if($res_check_sql[0]=='1'){
   
    header("Location: ../dashboard/index.php");
  }
if(isset($_SESSION['username'])){
header("location:../dashboard");
 }

?>

<html>
	<form name="first" action="" method="post">
		New Password: <input type="text" name="pass"><br/>
		Re-type New Password: <input type="text" name="repass"><br/>
		<input type="submit" name="submit" value="Change">
	</form>
</html>

<?php
$pass=$_POST['pass'];
$repass=$_POST['repass'];
echo $_SESSION['first_login'];

if(isset($_POST['submit']) && !empty($pass) && ($pass==$repass)){
	$sql=mysql_query("UPDATE `client` SET `client_pass`='$pass'") or die("Error in query");
	if(mysql_affected_rows()=='1'){
		$sql_flag=mysql_query("UPDATE `client` SET `client_log_flag`='1'") or die("Error");
		$_SESSION['first_login']=='false';
		echo "Password changed successfully. Redirecting you to the dashboard in 5 seconds...";
		echo $_SESSION['first_login'];
		header( "refresh:5;url=index.php" );
	}
}
?>