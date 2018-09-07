<?php 
session_start();
include('../dist/includes/dbcon.php');

	if(!isset($_GET['m_id']) || !isset($_GET['m_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $m_id=$_GET['m_id'];
    	mysqli_query($con,"CALL insert_delivery_member('$m_id',@deli_id,@m_id,@msg)");
    	$query = mysqli_query($con,"select @deli_id,@m_id")or die(mysqli_error($con));
        $result = mysqli_fetch_assoc($query);
        $deli_id = $result['@deli_id'];
        $m_id = $result['@m_id'];
        $status = "buy";
    	echo "<script>document.location='quick_buy_sell_member.php?deli_id=$deli_id&m_id=$m_id&status=$status'</script>";
} 
?>		