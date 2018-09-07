<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$category = mysqli_real_escape_string($con, $_POST['category']);
	mysqli_query($con,"CALL update_category('$id','$category',@msg)");
	echo "<script>document.location='category.php'</script>";	
?>
