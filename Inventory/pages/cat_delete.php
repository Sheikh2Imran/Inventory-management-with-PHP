<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');

    if(!isset($_GET['cat_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
    $cat_id=mysqli_real_escape_string($con, $_GET['cat_id']);
	mysqli_query($con,"CALL delete_category('$cat_id',@msg)");
	echo "<script>document.location='category.php'</script>";
    }	
?>
