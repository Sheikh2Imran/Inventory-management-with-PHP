<?php 
include('../dist/includes/dbcon.php');
    if(!isset($_GET['deli_id']) || $_GET['deli_id']==NULL){
         echo "<script> location.href='home.php'; </script>";
    }else{
        $deli_id = $_GET['deli_id'];
        $prod_id = $_GET['prod_id'];
    }
        mysqli_query($con,"CALL delete_borrow('$deli_id','$prod_id',@msg)");
        $query  = mysqli_query($con,"select @msg");
	    $result = mysqli_fetch_assoc($query);
	    $msg    = $result['@msg'];
	    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
        echo "<script>window.location = 'borrow.php';</script>";
?>