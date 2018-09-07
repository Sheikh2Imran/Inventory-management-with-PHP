<?php 
session_start();
include('../dist/includes/dbcon.php');
	if(!isset($_GET['m_id']) || !isset($_GET['m_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $m_id=$_GET['m_id'];
    	mysqli_query($con,"CALL insert_order(curdate(),'$m_id',@msg,@order)");
    	$query = mysqli_query($con,"select @order");
        $result = mysqli_fetch_assoc($query);
        $order_id = $result['@order'];
    	echo "<script>document.location='productOrder.php?order_id=$order_id&m_id=$m_id'</script>";
} 
?>		