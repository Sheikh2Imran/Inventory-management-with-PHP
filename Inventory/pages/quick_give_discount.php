<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
    if(!isset($_GET['status'])){
        echo "<script>location.href = 'home.php';</script>";
        }else{
        $status=$_GET['status'];
        }
        $deli_discount = $_POST['deli_discount'];
        $p_disc = $_POST['p_disc'];
        $deli_id = $_POST['deli_id'];
        $query=mysqli_query($con,"update create_delivery 
                    set
                    p_disc='$p_disc',
                    deli_discount='$deli_discount'
                    where deli_id='$deli_id'")or die(mysqli_error());
        echo "<script>document.location='quick_buy_sell.php?deli_id=$deli_id&status=$status'</script>";
?>