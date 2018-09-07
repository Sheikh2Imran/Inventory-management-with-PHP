<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$prod_name = $_POST['prod_name'];
	$type1 = $_POST['type1'];
	$type2 = $_POST['type2'];
	$type3 = $_POST['type3'];
	$type4 = $_POST['type4'];
	$selling_price = $_POST['selling_price'];
	$cat_id = $_POST['cat_id'];
	
	mysqli_query($con,"INSERT INTO product(prod_name,type1,type2,type3,type4,cat_id,selling_price) 
						VALUES('$prod_name','$type1','$type2','$type3','$type4','$cat_id','$selling_price')")
						or die(mysqli_error($con));
					
	echo "<script>document.location='product.php'</script>";
?>