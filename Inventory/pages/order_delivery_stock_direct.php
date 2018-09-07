<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

    include('../dist/includes/dbcon.php'); 
    if(!isset($_GET['deli_id']) || !isset($_GET['prod_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
        $prod_id=$_GET['prod_id'];
        $m_id=$_GET['m_id'];
    }
    $prod_new_qty = mysqli_real_escape_string($con, $_POST['delivary_stock']);
    $query=mysqli_query($con,"CALL insert_deli_det('$prod_id','$prod_new_qty',0.00,0.00,'$deli_id',@msg)")or die(mysqli_error());
	echo "<script>document.location='delivery_product_direct.php?m_id=$m_id&deli_id=$deli_id'</script>";  
?>
