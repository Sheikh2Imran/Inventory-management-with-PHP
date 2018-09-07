<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');
    if(!isset($_GET['order_id']) || $_GET['order_id']==NULL){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $order_id=$_GET['order_id'];
    } 
	mysqli_query($con,"CALL cancel_incmplt_order('$order_id',@msg)");
	echo "<script>document.location='incomplete_order.php'</script>"; 
?>