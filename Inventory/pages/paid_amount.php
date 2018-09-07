<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
	if(!isset($_GET['status'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $status = $_GET['status'];
	    $m_id = $_GET['m_id'];
	    $deli_id = $_GET['deli_id'];
	    $paid_amount = mysqli_real_escape_string($con, $_POST['paid_amount']);
	  $query=mysqli_query($con,"CALL update_payment_delivery('$deli_id','$paid_amount',@msg)");
	    echo "<script>document.location='quick_buy_sell_member.php?deli_id=$deli_id&m_id=$m_id&status=$status'</script>";
	}
?>