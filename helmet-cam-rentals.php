<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Helmet Cam Rentals in Summit County Colorado - Breckenridge, Keystone, Copper Mountain, Frisco, Dillon, and Silverthorne</title>
<meta http-equiv="Content-Type" content="text/html; charset =iso-8859-15" />
<meta name="keywords" content="services activities, things to do, breckenridge, keystone, copper mountain, frisco, dillon, silverthorne, activities" />
<meta name="description" content="Helmet Cam Rentals in Summit County Colorado - Breckenridge, Keystone, Copper Mountain, Frisco, Dillon, and Silverthorne." />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27868298-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div id="main" class="services">
<div class="center">
<?php require_once "logo.php"?>

<h2 >Helmet Cam Rentals</h2>
<h3>Breckenridge, Keystone, Copper Mountain, Frisco, Dillon, and Silverthorne</h3>
</div>
<table>
<tr>
<td>
<?php

require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database, $db_server)
	or die("Unable to select database: " . mysql_error());

$category = "helmet cam";
$query = "SELECT vendor_id, vendor_name, category, average_rating, logo, website, sort_by, description FROM vendors WHERE category = '$category' OR category2 = '$category' OR category3 = '$category' OR category4 = '$category' OR category5 = '$category' order by sort_by, vendor_name;";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);
	
for ($j = 0 ; $j < $rows ; ++$j)
{
	$row = mysql_fetch_row($result);
?>
	<table>
	<tr>
	<td>
	</td>
	<td>
	<a href="<?php echo $row[5]; ?>" target="_blank"><?php echo $row[1];?></a>
	</td></tr>
	<tr>
	<td>
	<a href="<?php echo $row[5]; ?>" target="_blank"><img src="images/<?php echo $row[4];?>" /></a>
	</td>	
	<td >
	<?php echo $row[7]; ?>
	</td>
	</tr>
	<tr class="feedback">
	<td><img src="<?php echo "images/rating-".$row[3].".png"; ?>" /></td>	
	<td >
	<a href="leave-feedback.php?id=<?php echo $row[0]; ?>">Leave Feedback</a>
	&nbsp;&nbsp;
	<a href="view-feedback.php?id=<?php echo $row[0]; ?>">View Feedback</a>
	</td>
	</tr>
	
	</tr>
	
	</table>
	<br />
	<?php
}

mysql_close($db_server);

?>
</td>
<td class="top">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5449698864781984";
/* Things to Do */
google_ad_slot = "5314825656";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td>
</tr>
</table>
</div>
<a href="index.php" alt="Home">Home</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="services.php" alt="All Services">All Services</a>
<?php require_once "footer.php"?>
</body>
</html>