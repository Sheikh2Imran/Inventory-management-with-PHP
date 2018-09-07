<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $pay_id   = mysqli_real_escape_string($con, $_POST['pay_id']);
        $pay_type = mysqli_real_escape_string($con, $_POST['pay_type']);
        $payment  = mysqli_real_escape_string($con, $_POST['payment']);

    mysqli_query($con,"CALL update_staff_payment('$pay_id','$payment','$pay_type',@msg)");
    echo "<script>document.location='staff_payment.php'</script>";
    }
?>