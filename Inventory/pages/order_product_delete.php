<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
?> 

<?php 
    if(!isset($_GET['od_id']) || $_GET['od_id']==NULL){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $od_id=$_GET['od_id'];
        $order_id=$_GET['order_id'];
        $m_id=$_GET['m_id'];
    }

include('../dist/includes/dbcon.php');
	mysqli_query($con,"CALL delete_order_det('$od_id',@msg)");
	echo "<script>document.location='productOrder.php?order_id=$order_id&m_id=$m_id'</script>";  
?>