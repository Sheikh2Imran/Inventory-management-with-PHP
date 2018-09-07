<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $exp_id = $_POST['exp_id'];
        $exp_date = $_POST['exp_date'];
        $payment = $_POST['payment'];
        $pay_type = $_POST['pay_type'];
        mysqli_query($con,"CALL update_expense('$exp_id','$payment','$pay_type',@msg)");
        echo "<script>document.location='expense.php'</script>";
    }
?>