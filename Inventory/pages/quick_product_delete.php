<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
?> 
<?php 
    include('../dist/includes/dbcon.php');
    if(!isset($_GET['deli_id']) || $_GET['deli_id']==NULL){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
        $m_id=$_GET['m_id'];
        $status=$_GET['status'];
        $dd_id=$_GET['dd_id'];
    }
    mysqli_query($con,"CALL delete_deli_det('$dd_id',@msg)"); 
	echo "<script>document.location='quick_buy_sell_member.php?deli_id=$deli_id&m_id=$m_id&status=$status'</script>";  
?>