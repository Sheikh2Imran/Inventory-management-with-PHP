<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $bt_id   	   = mysqli_real_escape_string($con, $_POST['bt_id']);
        $bt_amount     = mysqli_real_escape_string($con, $_POST['bt_amount']);
        $bt_status     = mysqli_real_escape_string($con, $_POST['bt_status']);
        $payment_type  = mysqli_real_escape_string($con, $_POST['payment_type']);
	    mysqli_query($con,"CALL update_bank_trans('$bt_id','$bt_amount','$bt_status','$payment_type',@msg)");
        $query = mysqli_query($con,"select @msg");
        $result = mysqli_fetch_assoc($query);
        $msg = $result['@msg'];
        echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
	    echo "<script>document.location='bank_trans.php'</script>";
    }
?>