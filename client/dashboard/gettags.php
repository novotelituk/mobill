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
<?php
if (isset($_POST['search'])) {
        $search = htmlentities($_POST['search']);
 
$db = mysql_connect('localhost','root',''); //Don't forget to change
mysql_select_db('mobill', $db);             //theses parameters
$sql = "SELECT * from product WHERE prod_name LIKE '$search%' AND prod_client_id='$ven_mail'";
$req = mysql_query($sql) or die();
echo '<ul>';
while ($data = mysql_fetch_array($req))
{
      echo '<li><a href="#" onclick="selected(this.innerHTML);">'.htmlentities($data['prod_name']).'---'.htmlentities($data['prod_mrp']).'</a></li>';

}
echo '</ul>';
mysql_close();
exit;
}
$prod=$_POST['prod'];
echo $prod;
?>