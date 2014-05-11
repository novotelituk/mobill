
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../settings/db.php');
if(!isset($_SESSION['fbid'])){
	header("Location: ../login/");
}



if(isset($_SESSION['fbid']))
{
	echo '<a href="shop.php">Shops</a><br/>';
	echo '<a href="history.php">History</a><br/>';
	echo '<a href="expense.php">Expense Tracker</a><br/>';
	echo '<a href="usersettings.php">Settings</a><br/>';
	echo '<a href="logout.php">Logout</a><br/>';

}

?>



