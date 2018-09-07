<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
	$trans_id =$_POST['trans_id'];
	$trans_date =$_POST['trans_date'];
	$mem_id =$_POST['mem_id'];
	
	mysqli_query($con,"update transaction_order 
						set 
						trans_id='$trans_id',
						trans_date='$trans_date' 
						where mem_id='$mem_id'")or die(mysqli_error());

	echo "<script>document.location='creat_trans.php?mem_id=$mem_id'</script>";
?>
