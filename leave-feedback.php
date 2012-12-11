<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Feedback on Activities in Summit County Colorado - Breckenridge, Keystone, Copper Mountain, Frisco, Dillon, and Silverthorne</title>
<meta http-equiv="Content-Type" content="text/html; charset =iso-8859-15" />
<meta name="keywords" content="services activities, things to do, breckenridge, keystone, copper mountain, frisco, dillon, silverthorne, activities" />
<meta name="description" content="Leave Feedback on Activities in Summit County Colorado - Breckenridge, Keystone, Copper Mountain, Frisco, Dillon, and Silverthorne." />
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
<script type="text/javascript">
function formOK () {
//this function checks to make sure valid form data was entered.
  var ok = true;
  if (document.forms["form1"].firstName.value.length == 0)
	 { alert("Please enter your first name.");
	   ok = false;
	 };
  if (ok && (document.forms["form1"].lastName.value.length == 0))
     { alert("Please enter your last name.");
	   ok = false;
	 };

  return ok;
}//formOK
</script>
<?php 

require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database, $db_server)
	or die("Unable to select database: " . mysql_error());

$_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
$ip_address = $_SESSION['ip_address'];
	
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
if (isset($_POST['submit']))
{
	$comments = $_POST['comments'];
	$first_name = $_POST['firstName'];
	$last_name = $_POST['lastName'];
	$rating = $_POST['rating'];
	$ip_address = $_SESSION['ip_address'];
	$vendor = $_POST['vendor'];
	$pos1 = strpos($comments, "<a");
	$pos2 = strpos($comments, "http");
	$pos3 = strpos($comments, "www");
	if ($pos1 === false && $pos2 === false && $pos3 === false)
	{
		$sql = "insert into vendor_feedback (ip_address, vendor_id, first_name, last_name, comment, rating) values ('$ip_address', $vendor, '$first_name', '$last_name', '$comments', $rating)";
		$result = mysql_query($sql);
		if ($result)
		{
			$success = "true";
			$to = "rick@coloradotravelmaster.com";
			$subject = "New Rating on RAN SCAN";
			$body = " IP Address: $ip_address \n Vendor ID: $vendor \n Name: $first_name $last_name \n Comments: $comments \n Rating: $rating";
			$sql3 = "select ROUND(AVG(rating)) as avg_rating from vendor_feedback where vendor_id = $vendor";
			$result3 = mysql_query($sql3);
	
			while ($row=mysql_fetch_assoc($result3)) 
			{
				$avg_rating = $row["avg_rating"];
				
				$sql2 = "update vendors set average_rating = $avg_rating where vendor_id = $vendor";
				$result2 = mysql_query($sql2);
			}		
			
			mail($to, $subject, $body, null, '-finfo@coloradotravelmaster.com');
			mysql_close($db_server);
		}
		else 
		{
			$success = "false";
			mysql_close($db_server);
			
		}
	}
	else
	{
		$body = " IP Address: $ip_address \n Vendor ID: $vendor \n Name: $first_name $last_name \n Comments: $comments \n Rating: $rating";
		$to = "rick@coloradotravelmaster.com";
		$subject = "Got a Spammer on RAN SCAN!";
		mail($to, $subject, $body, null, '-frick@coloradotravelmaster.com');
		$success = "false";
		mysql_close($db_server);
	}
}
?>
</head>
<body>
<div id="main" class="services">
<div class="center">
<?php 
if ($success == "true")
{
		echo "<h2>Thank you for your feedback!</h2>";
		echo "</div>";
}
else {
	echo '<div id="logo">';
	echo '<img src="images/feedback.png" alt="Feedback" /></a>';

	echo '<h1 >Feedback for<br />';
	echo $vendor_name;
	echo '</h1>';
	echo '</div>';
	
?>
</div>
<div class="feedback-form">
	<form id="form1" name="DateForm" method="post" action="leave-feedback.php" onsubmit="return formOK();">

<table width="550" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%">First Name</td>
  </tr>
  <tr>
    <td width="70%"><input type="text" name="firstName" id="firstName" size="80" /></td>
  </tr>
  <tr>
    <td>Last Name</td>
  </tr>
  <tr>
    <td><input type="text" name="lastName" id="lastName"  size="80"/></td>
  </tr>
  <tr>
    <td>Rating</td>
  </tr>
  <tr>
    <td><select name="rating" size="1"><option value="1">One Star - Poor</option><option value="2">Two Stars</option><option value="3">Three Stars</option><option value="4">Four Stars</option><option value="5">Five Stars - Excellent</option></select>
  </tr>
  <tr>
    <td>Comments</td>
  </tr>
  <tr>
  	<td><textarea name="comments" cols="80" rows="3" wrap="hard"></textarea></td>
  </tr>
</table>
<input type="hidden" name="submit" value="true" />
<input type="hidden" name="vendor" value="<?php echo $vendor_id;?>" />
<input type="submit" name="button" id="button" value="Submit Feedback" />

</form>
<?php } ?>
</div>
<a href="index.php" alt="Home">Home</a>
<?php require_once "footer.php"?>
</body>
</html>