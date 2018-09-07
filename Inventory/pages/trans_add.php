<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
	$trans_id =$_POST['trans_id'];
	$trans_date =$_POST['trans_date'];
	$mem_id =$_POST['mem_id'];
	
	mysqli_query($con,"insert into transaction_order(trans_id,trans_date,mem_id) values('$trans_id','$trans_date','$mem_id')")or die(mysqli_error());
	
	echo "<script>document.location='creat_trans.php?mem_id=$mem_id'</script>";  

	
?>