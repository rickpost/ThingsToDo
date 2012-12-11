<?php

function getVendors($category)
{
	require_once 'login.php';
	$db_server = mysql_connect($db_hostname, $db_username, $db_password);
	
	if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
	
	mysql_select_db($db_database, $db_server)
		or die("Unable to select database: " . mysql_error());
	
	$query = "SELECT 
	v.vendor_id,
	if(length(vc.vendor_name) > 0, vc.vendor_name, v.vendor_name) as vendor_name,
	if(length(vc.logo) > 0, vc.logo, v.logo) as logo,
	if(length(vc.logo_ctm) > 0, vc.logo_ctm, v.logo_ctm) as logo_ctm,
	if(length(vc.ad) > 0, vc.ad, v.ad) as ad,
	if(length(vc.website) > 0, vc.website, v.website) as website,
	if(length(vc.description) > 0, vc.description, v.description) as description,
	if(length(vc.coupon_text) > 0, vc.coupon_text, v.coupon_text) as coupon_text,
	if(length(vc.info) > 0, vc.info, v.info) as info,
	if(length(vc.link) > 0, vc.link, v.link) as link,
	if(length(vc.link_text) > 0, vc.link_text, v.link_text) as link_text,
	v.status_ctm,
	v.status_scan
	FROM vendors v
	INNER JOIN vendor_categories vc ON vc.vendor_id = v.vendor_id
	WHERE vc.category = '$category' 
	and v.status_scan <> 'Hide'
	order by v.sort_by, if(length(vc.vendor_name) > 0, vc.vendor_name, v.vendor_name)";
		
	$result = mysql_query($query);
	
	if (!$result) die ("Database access failed: " . mysql_error());
		
	mysql_close($db_server);
	return $result;
}
?>


