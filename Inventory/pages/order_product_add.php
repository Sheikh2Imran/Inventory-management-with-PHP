<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$id_order = $_POST['id_order'];
	$prod_id = $_POST['prod_id'];
	$query1=mysqli_query($con,"select prod_id from order_purchase where id_order=$id_order") or die(mysqli_error($con));
	$row1=mysqli_fetch_array($query1);
	$prod_id_check = $row1['prod_id'];

	if ($prod_id_check != $prod_id) {
	$query2=mysqli_query($con,"select * from member_status_view where id_order='$id_order'")or die(mysqli_error());
    $row2=mysqli_fetch_array($query2);
    $member_status = $row2['member_status'];
    if ($member_status == "customer") {
	
	$prod_id = $_POST['prod_id'];
	$prod_qty = $_POST['prod_qty'];
	$id_order = $_POST['id_order'];

	$query3=mysqli_query($con,"select product_selling_price_view from product_view where prod_id_view='$prod_id'") or die(mysqli_error($con));
	$row3=mysqli_fetch_array($query3);
	$unit_price_view = $row3['product_selling_price_view'];

	mysqli_query($con,"INSERT INTO order_purchase(prod_id,unit_price,prod_qty,id_order) 
						VALUES('$prod_id','$unit_price_view','$prod_qty','$id_order')")
						or die(mysqli_error($con));	
	} else{
		$prod_id = $_POST['prod_id'];
		$unit_price = $_POST['unit_price'];
		$prod_qty = $_POST['prod_qty'];
		$id_order = $_POST['id_order'];
		mysqli_query($con,"INSERT INTO order_purchase(prod_id,unit_price,prod_qty,id_order) 
						VALUES('$prod_id','$unit_price','$prod_qty','$id_order')")
						or die(mysqli_error($con));
	}

	$query4=mysqli_query($con,"select id_order from tbl_order order by id_order desc limit 1") or die(mysqli_error($con));
	$row4=mysqli_fetch_array($query4);
	$id_order=$row4['id_order'];
	echo "<script>document.location='productOrder.php?id_order=$id_order'</script>";	
	} else{
		echo "<script type='text/javascript'>alert('This product is already inserted! Please update the quantity to get more !!');</script>";
		echo "<script>document.location='productOrder.php?id_order=$id_order'</script>";
	}
?>