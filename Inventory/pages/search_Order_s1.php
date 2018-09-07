<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	if (isset($_POST['submit'])) {
    $trans_id = $_POST['trans_id'];
	echo "<script>document.location='addOrder_seller.php?trans_id=$trans_id'</script>";  
	}else{
		echo "<script>document.location='home.php'</script>"; 
	}
?>
