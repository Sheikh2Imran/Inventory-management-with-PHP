<?php 
include('../dist/includes/dbcon.php');
    if(!isset($_GET['order_id']) || $_GET['order_id']==NULL){
         echo "<script> location.href='home.php'; </script>";
    }else{
        $order_id = $_GET['order_id'];
    }
	mysqli_query($con,"CALL insert_delivery_order('$order_id',@deli,@status)");	
	$query = mysqli_query($con,"select @deli");
    $result = mysqli_fetch_assoc($query);
    $deli_id = $result['@deli'];

	echo "<script>document.location='delivery_product.php?order_id=$order_id&deli_id=$deli_id'</script>";
?>