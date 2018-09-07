<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
?> 
<?php 
include('../dist/includes/dbcon.php');
    if(!isset($_GET['deli_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
    $deli_id=$_GET['deli_id'];
    $status=$_GET['status'];

	mysqli_query($con,"INSERT INTO delivery_details SELECT * FROM delivery_details_temp where deli_id='$deli_id'") or die(mysqli_error($con)); 

    mysqli_query($con,"DELETE FROM delivery_details_temp where deli_id='$deli_id'") or die(mysqli_error($con));
    
	echo "<script>document.location='quick_buy_sell.php?deli_id=$deli_id&status=$status'</script>";
}
?>
