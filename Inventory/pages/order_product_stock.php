<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
?> 
<?php 
    if(!isset($_GET['id_order']) || !isset($_GET['prod_id'])){
        echo "<script>location.href = 'productOrder.php';</script>";
    }else{
        $id_order=$_GET['id_order'];
        $prod_id=$_GET['prod_id'];
    }
include('../dist/includes/dbcon.php');
	$query=mysqli_query($con,"select prod_deli_qty from order_purchase where prod_id='$prod_id' AND id_order='$id_order'")or die(mysqli_error());
    $row=mysqli_fetch_array($query);
    $old_deli_qty = $row['prod_deli_qty'];
    $delivary_stock = $_POST['delivary_stock'];
    $new_deli_qty = $old_deli_qty+$delivary_stock;

    mysqli_query($con,"update order_purchase 
						set 
						prod_deli_qty='$new_deli_qty'
						where prod_id='$prod_id' AND id_order='$id_order'") or die(mysqli_error($con));	

	$query1=mysqli_query($con,"select prod_qty from product where prod_id='$prod_id'")or die(mysqli_error());
    $row1=mysqli_fetch_array($query1);
    $qty_old = $row1['prod_qty'];
    $delivary_stock = $_POST['delivary_stock'];
    $final_qty = $qty_old+$delivary_stock;
    
	mysqli_query($con,"update product 
						set 
						prod_qty='$final_qty'
						where prod_id='$prod_id'") or die(mysqli_error($con));    

	echo "<script>document.location='productOrder.php?id_order=$id_order'</script>";  
?>
