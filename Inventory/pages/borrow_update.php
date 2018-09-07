<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $prod_id = $_POST['prod_id'];
        $deli_id = $_POST['deli_id'];
        $prod_qty = $_POST['prod_qty'];
        $r_date = $_POST['r_date'];
    mysqli_query($con,"CALL update_borrow('$prod_id','$deli_id','$prod_qty','$r_date',@msg)");
    echo "<script>document.location='borrow.php'</script>";
    }
?>