<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../settings/db.php');
if(!isset($_SESSION['fbid'])){
	header("Location: ../login/");
}
$sql_shop=mysql_query("SELECT * from `client`") or die("error");

while($row=mysql_fetch_array($sql_shop))
{	
	$shopcode=$row[0];
	echo '
	<ul>
	<li><a href="shoppage.php?shopcode='.$shopcode.'">'.$row[1].'</a></li>
	</ul>';
}
if(isset($_GET['shopcode']))
{
	$code=$_GET['shopcode'];
	echo $code;
}
?>