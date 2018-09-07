<?php 
include('../dist/includes/dbcon.php');

	$query=mysqli_query($con,"CALL insert_delivery(curdate(),'sell',NULL,NULL,@deli,@status)");
	$query1=mysqli_query($con,"select @deli,@status");
	$row=mysqli_fetch_array($query1);
	$deli_id = $row['@deli'];
	$status = $row['@status'];
	echo "<script>document.location='quick_buy_sell.php?deli_id=$deli_id&status=$status'</script>";  
?>