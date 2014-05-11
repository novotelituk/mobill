<?php
ob_start();
session_start();
if(isset($_SESSION['login_user'])){
header("location:../dashboard");
 }
include("../../settings/db.php");
?>


 <form action="" method="post">
      
        <label>Username</label>
        
          
            <input type="text" placeholder="Username" name="email"/>
          
        <label>Password</label>
        
            <input type="password" placeholder="Password" name="password"/>
         
        <input type="submit" name="submit" value="Login">
        
    </form>

<?php
 //error_reporting (E_ALL ^ E_NOTICE); 
 if(isset($_POST['submit'])){
     
 

      $client_email=strtolower(mysql_real_escape_string(trim($_POST['email'])));
      $password=mysql_real_escape_string(trim($_POST['password']));
   
      
      if(!empty($client_email) && !empty($password)){
        $query="SELECT * FROM `client` where `client_email`='$client_email' AND `client_pass`='$password'";
        $result=mysql_query($query);
        
        if(mysql_num_rows($result)==1){
  //session_start();
  $_SESSION['last_login']=$last_login;
  $_SESSION['login_user']=$client_email;

  
  $sql=mysql_query("UPDATE client SET client_last_log=NOW() where client_email='$client_email'");
  $check_sql=mysql_query("SELECT `client_log_flag` from `client` where `client_email`='$client_email'") or die("Error");
  $res_check_sql=mysql_fetch_row($check_sql);
  
  if($res_check_sql[0]=='0'){
   
    header("Location: ../dashboard/first_log.php");
  }
  elseif($res_check_sql[0]=='1'){
  header("location:../dashboard");
                echo '<div id="notify">
	    <p>Authentication Successful! :)</p>
	   </div>';
   }
     }
     else echo '<div id="notify">
	    <p>You made a boo boo! Wrong Username or Password!</p>
	   </div>';

} 
else {echo  '<div id="notify">
	    <p>We mean to get all the fields to be filled.</p>
	   </div>';}   
}	   
ob_end_flush();
?>
