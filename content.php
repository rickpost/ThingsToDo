<?php
require_once 'vendor_engine.php';
$result = getVendors($category);
while ($row = mysql_fetch_array($result))
{
?>
	<table>
	<tr>
	<td>
	</td>
	<td>
	<div class="vendor-link" vendorid="<?php echo $row['vendor_id'];?>" source="scan" ip="<?php echo$_SERVER['REMOTE_ADDR'];?>" ><a href="<?php echo $row['website']; ?>" target="_blank" ><?php echo $row['vendor_name'];?></a></div>
	</td></tr>
	<tr>
	<td>
	<div class="vendor-link" vendorid="<?php echo $row['vendor_id'];?>" source="scan" ip="<?php echo$_SERVER['REMOTE_ADDR'];?>" ><a href="<?php echo $row['website']; ?>" target="_blank" ><img src="images/<?php echo $row['logo'];?>" /></a></div>
	</td>	
	<td >
	<?php echo $row['description']; ?>
	</td>
	</tr>
	<tr class="feedback">
	<td><img src="<?php echo "images/rating-".$row['average_rating'].".png"; ?>" /></td>	
	<td >
	<a href="leave-feedback.php?id=<?php echo $row['vendor_id']; ?>">Leave Feedback</a>
	&nbsp;&nbsp;
	<a href="view-feedback.php?id=<?php echo $row['vendor_id']; ?>">View Feedback</a>
	</td>
	</tr>
	
	</tr>
	
	</table>
	<br />
	<?php
}
?>