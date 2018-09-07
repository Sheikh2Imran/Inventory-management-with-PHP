<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

	$prod_id 		 = mysqli_real_escape_string($con, $_POST['prod_id']);
	$prod_name 		 = mysqli_real_escape_string($con, $_POST['prod_name']);
	$prod_desc 	 	 = mysqli_real_escape_string($con, $_POST['prod_desc']);
	$prod_desc1 	 = mysqli_real_escape_string($con, $_POST['prod_desc1']);
	$prod_desc2 	 = mysqli_real_escape_string($con, $_POST['prod_desc2']);
	$prod_desc3 	 = mysqli_real_escape_string($con, $_POST['prod_desc3']);
	$prod_desc_short = mysqli_real_escape_string($con, $_POST['prod_desc_short']);
	$unit_price_buy  = mysqli_real_escape_string($con, $_POST['unit_price_buy']);
	$unit_price_sell = mysqli_real_escape_string($con, $_POST['unit_price_sell']);
	$cat_id          = mysqli_real_escape_string($con, $_POST['cat_id']);
			
	mysqli_query($con,"CALL update_product('$prod_id','$prod_name','$prod_desc','$prod_desc1','$prod_desc2','$prod_desc3','$prod_desc_short','$unit_price_buy','$unit_price_sell','$cat_id',@msg,@prod_id)");
	echo "<script>document.location='product.php'</script>";  
?>
