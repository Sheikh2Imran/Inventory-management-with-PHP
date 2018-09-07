<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $m_id     = mysqli_real_escape_string($con, $_POST['m_id']);
        $pay_date = mysqli_real_escape_string($con, $_POST['pay_date']);
        $payment  = mysqli_real_escape_string($con, $_POST['payment']);
        
    mysqli_query($con,"CALL insert_payment('$m_id','$pay_date','$payment',@msg)");
    $query = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='ledger_supplier.php?m_id=$m_id'</script>";
    }
?>