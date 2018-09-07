<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
    if(!isset($_GET['deli_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
    $deli_id=$_GET['deli_id'];
    $m_id=$_GET['m_id'];
    $status=$_GET['status'];
    }
    $dd_id = mysqli_real_escape_string($con, $_POST['dd_id']);
	$prod_price = mysqli_real_escape_string($con, $_POST['prod_price']);
	$dd_qty = mysqli_real_escape_string($con, $_POST['dd_qty']);
	$dd_discount = mysqli_real_escape_string($con, $_POST['pdisc']);
	$vat = mysqli_real_escape_string($con, $_POST['pvat']);

	mysqli_query($con,"CALL update_deli_det('$dd_id','$prod_price','$dd_qty','$dd_discount','$vat',@deli_id,@msg)"); 
    $query = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='quick_buy_sell_member.php?deli_id=$deli_id&m_id=$m_id&status=$status'</script>";
?>
