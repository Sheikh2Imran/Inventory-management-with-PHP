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
        $order_id=$_GET['order_id'];
    }
     $dd_qty = mysqli_real_escape_string($con, $_POST['dd_qty']);
    $query=mysqli_query($con,"CALL insert_deli_det('$prod_id','$dd_qty','$deli_id',@msg)");
   echo "<script>document.location='delivery_product.php?order_id=$order_id&deli_id=$deli_id'</script>";  
?>
