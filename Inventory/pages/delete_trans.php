<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
?> 
<?php 
    if(!isset($_GET['trans_id']) || $_GET['trans_id']==NULL){
        echo "<script>location.href = 'member.php';</script>";
    }else{
        $trans_id=$_GET['trans_id'];
        $mem_id=$_GET['mem_id'];
    }

include('../dist/includes/dbcon.php');
	mysqli_query($con,"delete from transaction_order where trans_id='$trans_id'") or die(mysqli_error($con));
	mysqli_query($con,"delete from tbl_order where trans_id='$trans_id'") or die(mysqli_error($con));
    
	echo "<script>document.location='creat_trans.php?mem_id=$mem_id'</script>";  
?>