<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

	$mem_id  = mysqli_real_escape_string($con, $_POST['m_id']);
	$status  = mysqli_real_escape_string($con, $_POST['m_status']);
	$dor     = mysqli_real_escape_string($con, $_POST['m_dor']);	
	$name    = mysqli_real_escape_string($con, $_POST['m_name']);
	$company = mysqli_real_escape_string($con, $_POST['m_company']);
	$address = mysqli_real_escape_string($con, $_POST['m_addr']);
	$contact = mysqli_real_escape_string($con, $_POST['m_mob']);
	$email   = mysqli_real_escape_string($con, $_POST['m_email']);
			
	mysqli_query($con,"CALL update_member('$mem_id','$status','$dor','$name','$company','$address','$contact','$email',@msg,@m_id)")or die(mysqli_error($con));
	echo "<script>document.location='member.php'</script>";  
	
?>