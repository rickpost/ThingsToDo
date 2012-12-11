<?php 
require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
require_once 'sanitize.php';
$action = $_REQUEST['action'];
$item_id = $_REQUEST['itemid'];
$ip_address = $_REQUEST['ip'];
$quantity = $_REQUEST['quantity'];
$details = $_REQUEST['details'];
$create_date = $_REQUEST['create_date'];
$create_time = $_REQUEST['create_time'];
$source = $_REQUEST['source'];

//echo "in ajax functions php action is ".$action." quantity is ".$_REQUEST['quantity']." details are ".$_REQUEST['details']." ip is ".$ip_address;

switch ($action)
{
	case "pm_quantity" :
	{
//	echo "<br />in pm_quantity";
		$sql = "update meal_carts set quantity = $quantity where ip_address='$ip_address' and meal_id = $item_id";
//		echo "<br />about to execute ".$sql;
		mysql_query($sql);
		break;
	}
	case "pm_details" :
	{
//	echo "<br />in pm_details";
		$sql = "update meal_carts set details = '$details' where ip_address='$ip_address' and meal_id = $item_id";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
	case "gs_quantity" :
	{
//	echo "<br />in gs_quanmtity";
	$sql = "update shopping_carts set quantity = $quantity where ip_address='$ip_address' and item_id = $item_id and create_date = '$create_date $create_time'";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
	case "gs_details" :
	{
//	echo "<br />in gs_details";
	$sql = "update shopping_carts set details = '$details' where ip_address='$ip_address' and item_id = $item_id and create_date = '$create_date $create_time'";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
	case "ctm_url" :
	{
	echo "<br />in ctm_url";
	$sql = "insert into clicks (click_date, ip_address, vendor_id, type, source) values (now(), '$ip_address', $item_id, 'link', 'ctm')";
		mysql_query($sql);
		echo "<br />about to execute ".$sql;
		break;
	}
	case "ctm_coupon" :
	{
//	echo "<br />in ctm_coupon";
	$sql = "insert into clicks (click_date, ip_address, vendor_id, type, source) values (now(), '$ip_address', $item_id, 'coupon', 'ctm')";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
	case "ctm_ad" :
	{
//	echo "<br />in ctm_ad";
	$sql = "insert into clicks (click_date, ip_address, vendor_id, type, source) values (now(), '$ip_address', $item_id, 'ad', 'ctm')";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
	case "ctm_print" :
	{
//	echo "<br />in ctm_print";
	$sql = "insert into clicks (click_date, ip_address, vendor_id, type, source) values (now(), '$ip_address', $item_id, 'print', 'ctm')";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
	case "scan_url" :
	{
//	echo "<br />in acan_url";
	$sql = "insert into clicks (click_date, ip_address, vendor_id, type, source) values (now(), '$ip_address', $item_id, 'link', 'scan')";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
	case "scan_coupon" :
	{
//	echo "<br />in scan_coupon";
	$sql = "insert into clicks (click_date, ip_address, vendor_id, type, source) values (now(), '$ip_address', $item_id, 'coupon', 'scan')";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
	case "scan_ad" :
	{
//	echo "<br />in scan_ad";
	$sql = "insert into clicks (click_date, ip_address, vendor_id, type, source) values (now(), '$ip_address', $item_id, 'ad', 'acan')";
		mysql_query($sql);
//		echo "<br />about to execute ".$sql;
		break;
	}
}

mysql_close($db_server);
	
?>
	