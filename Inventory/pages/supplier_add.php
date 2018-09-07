<?php 

include('../dist/includes/dbcon.php');

	$name = $_POST['name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$status = $_POST['status'];
	$dor = $_POST['dor'];	
			
			mysqli_query($con,"INSERT INTO supplier(supplier_name,supplier_address,supplier_contact,supplier_status,supplier_dor) 
				VALUES('$name','$address','$contact','$status','$dor')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new supplier!');</script>";
					  echo "<script>document.location='supplier.php'</script>";  
	
?>