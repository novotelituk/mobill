<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../settings/db.php');
if(!isset($_SESSION['fbid'])){
	header("Location: ../login/");
}
$fbid=$_SESSION['fbid'];




$sql_trans=mysql_query("SELECT * from `transaction` WHERE `tr_user_id`='$fbid'") or die("Error");
?>