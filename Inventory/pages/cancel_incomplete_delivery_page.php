<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');
    if(!isset($_GET['deli_id']) || $_GET['deli_id']==NULL){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
    } 
	mysqli_query($con,"CALL cancel_incomplete_delivery('$deli_id',@msg)");
	echo "<script>document.location='incomplete_delivery.php'</script>"; 
?>