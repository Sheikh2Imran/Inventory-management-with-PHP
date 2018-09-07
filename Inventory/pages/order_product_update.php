<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php'); 
    if(!isset($_GET['order_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
	    $order_id=$_GET['order_id'];
	    $m_id=$_GET['m_id'];

		$prod_id    = mysqli_real_escape_string($con, $_POST['prod_id']);
		$od_id      = mysqli_real_escape_string($con, $_POST['od_id']);
		$od_qty     = mysqli_real_escape_string($con, $_POST['od_qty']);
		$prod_price = mysqli_real_escape_string($con, $_POST['prod_price']);
		$p_disc     = mysqli_real_escape_string($con, $_POST['p_disc']);

	mysqli_query($con,"CALL update_order_det('$od_id','$prod_id','$od_qty','$prod_price','$p_disc',@order_id,@msg)");
	echo "<script>document.location='productOrder.php?order_id=$order_id&m_id=$m_id'</script>";
}
?>
