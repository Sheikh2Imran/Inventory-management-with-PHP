<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
    if(!isset($_GET['order_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
    $order_id = $_GET['order_id'];
    $m_id = $_GET['m_id'];
	$query=mysqli_query($con,"CALL cancel_order('$order_id',@msg)");
    $qry = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($qry);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='addOrder_buyer.php?m_id=$m_id'</script>";
    }	
?>