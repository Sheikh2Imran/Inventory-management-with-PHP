<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

if (isset($_POST['submit'])) {
	$name = $_POST['mem_name'];
	$address = $_POST['mem_addr'];
	$contact = $_POST['mem_contact'];
	$email = $_POST['mem_email'];
	$company_name = $_POST['company_name'];
	$status = $_POST['mem_status'];
	$dor = $_POST['mem_dor'];	
			
	mysqli_query($con,"INSERT INTO member(mem_name,mem_addr,mem_contact,mem_email,company_name,mem_status,mem_dor) 
		VALUES('$name','$address','$contact','$email','$company_name','$status','$dor')")or die(mysqli_error($con));

	echo "<script>document.location='member.php'</script>";  	
}	
?>