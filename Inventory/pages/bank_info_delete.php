<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
    if(!isset($_GET['bank_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
    $bank_id=mysqli_real_escape_string($con, $_GET['bank_id']);
	mysqli_query($con,"CALL delete_bank_info('$bank_id',@msg)");
	echo "<script>document.location='bank_info.php'</script>";
    }	
?>
