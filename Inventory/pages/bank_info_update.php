<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
	$bank_id = mysqli_real_escape_string($con, $_POST['bank_id']);
	$bank_name = mysqli_real_escape_string($con, $_POST['bank_name']);
	$bank_branch = mysqli_real_escape_string($con, $_POST['bank_branch']);
	$bank_district = mysqli_real_escape_string($con, $_POST['bank_district']);
	$opening_date = mysqli_real_escape_string($con, $_POST['openning_date']);

	mysqli_query($con,"CALL update_bank_info('$bank_id','$bank_name','$bank_branch','$bank_district','$opening_date',@msg)");
	echo "<script>document.location='bank_info.php'</script>";	
?>