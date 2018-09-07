<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');
	

	if (isset($_POST['submit'])) {
	$quick_id = $_POST['quick_id'];
	$prod_id = $_POST['prod_id'];
	$query4=mysqli_query($con,"select status from quick_buy_sell where quick_id='$quick_id'")or die(mysqli_error($con));
    $row4=mysqli_fetch_array($query4);
    $status = $row4['status'];
	if ($status != "customer") {
		$unit_price = $_POST['unit_price'];
	}
	$prod_qty = $_POST['prod_qty'];

	$query=mysqli_query($con,"select prod_id from quick_transection where quick_id='$quick_id'") or die(mysqli_error($con));
	$row=mysqli_fetch_array($query);
	$prod_id_check = $row['prod_id'];

	if ($prod_id != $prod_id_check) {
    $query2=mysqli_query($con,"select product_selling_price_view from product_view where prod_id_view='$prod_id'") or die(mysqli_error($con));
	$row2=mysqli_fetch_array($query2);
	$unit_price_view = $row2['product_selling_price_view'];

	$query3=mysqli_query($con,"select prod_qty from product where prod_id='$prod_id'")or die(mysqli_error());
    $row3=mysqli_fetch_array($query3);
    $old_prod_qty = $row3['prod_qty'];

    $query1=mysqli_query($con,"select * from quick_buy_sell where quick_id='$quick_id'")or die(mysqli_error());
    $row1=mysqli_fetch_array($query1);
    $status = $row1['status'];
    if ($status == "customer") {
    	$new_prod_qty = $old_prod_qty-$prod_qty; 
	} else{
    	$new_prod_qty = $old_prod_qty+$prod_qty; 
	}

    mysqli_query($con,"UPDATE product 
    					SET 
    					prod_qty='$new_prod_qty' WHERE prod_id='$prod_id'")
						or die(mysqli_error($con));	

	mysqli_query($con,"INSERT INTO quick_transection(quick_id	,prod_id,unit_price,prod_qty) 
						VALUES('$quick_id','$prod_id','$unit_price_view','$prod_qty')")
						or die(mysqli_error($con));	

	echo "<script>document.location='quick_buy_sell.php?quick_id=$quick_id'</script>";	
	} else{
		echo "<script type='text/javascript'>alert('This product is already inserted! Please update the quantity to get more !!');</script>";
		echo "<script>document.location='quick_buy_sell.php?quick_id=$quick_id'</script>";
	}
}
?>