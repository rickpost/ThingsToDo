<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>View Feedback on Activities in Summit County Colorado - Breckenridge, Keystone, Copper Mountain, Frisco, Dillon, and Silverthorne</title>
<meta http-equiv="Content-Type" content="text/html; charset =iso-8859-15" />
<meta name="keywords" content="services activities, things to do, breckenridge, keystone, copper mountain, frisco, dillon, silverthorne, activities" />
<meta name="description" content="View Feedback on Activities in Summit County Colorado - Breckenridge, Keystone, Copper Mountain, Frisco, Dillon, and Silverthorne." />
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
<?php 

require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database, $db_server)
	or die("Unable to select database: " . mysql_error());

if (isset($_GET['id']))
{
	$vendor_id = $_GET['id'];
	$sql1 = "select vendor_name from vendors where vendor_id = $vendor_id";
	$result1 = mysql_query($sql1);
	$vendor_name = '';
	while ($row=mysql_fetch_assoc($result1)) 
	{
		$vendor_name = $row["vendor_name"];
	}
}
?>
</head>
<body>
<div id="main" class="services">
<div class="center">
<h1 >Feedback for<br />
<?php 	echo $vendor_name;
	echo '</h1>';
?>
</div>
<?php 	

$query = "SELECT first_name, last_name, rating, comment FROM vendor_feedback WHERE vendor_id = $vendor_id order by feedback_date desc;";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);
	
for ($j = 0 ; $j < $rows ; ++$j)
{
	$row = mysql_fetch_row($result);
?>


<table width="700" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%">First Name</td>
    <td width="70%"><?php echo $row[0];?></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><?php echo $row[1];?></td>
  </tr>
  <tr>
    <td>Rating</td>
	<td><img src="<?php echo "images/rating-".$row[2].".png"; ?>" /></td>	
  </tr>
  <tr>
    <td>Comments</td>
  	<td><text cols="80" rows="3"><?php echo $row[3];?></text></td>
  </tr>
</table>
<br />
<?php } ?>
</div>
<a href="index.php" alt="Home">Home</a>
<?php require_once "footer.php"?>
</body>
</html>